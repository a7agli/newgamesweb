import { createClient } from "https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/+esm";

const SUPABASE_URL = "https://ccdwyvxxyegqwfttrlnq.supabase.co";
const SUPABASE_PUBLISHABLE_KEY = "sb_publishable_6gfRBMc4glaFFYsFsYAJwA_Y1V1GVjj";
const supabase = createClient(SUPABASE_URL, SUPABASE_PUBLISHABLE_KEY);

const STYLE = `
#frazer-account-shade{position:fixed;inset:0;z-index:1000000;background:#05070bb8;display:none;align-items:center;justify-content:center;padding:18px;font-family:Inter,system-ui,sans-serif}
#frazer-account-card{width:min(420px,100%);background:#171b24;color:#f7f8fb;border:1px solid #ffffff22;border-radius:22px;padding:24px;box-shadow:0 24px 80px #0008}
#frazer-account-card h2{margin:0 0 7px;font-size:23px}
#frazer-account-card p{color:#aeb7c7;font-size:13px;line-height:1.5}
#frazer-account-card input{box-sizing:border-box;width:100%;margin:7px 0;padding:13px 14px;border-radius:11px;border:1px solid #ffffff24;background:#0e121a;color:white;font-size:14px}
#frazer-account-card button{border:0;border-radius:11px;padding:12px 14px;font-weight:700;cursor:pointer}
#frazer-account-card .primary{width:100%;background:#fff;color:#10131a;margin-top:9px}
#frazer-account-card .secondary{background:#ffffff14;color:#fff}
#frazer-account-actions{display:flex;gap:8px;margin-top:8px}
#frazer-account-actions button{flex:1}
#frazer-account-message{min-height:20px;color:#b8d7ff;font-size:12px;margin-top:10px;overflow-wrap:anywhere}
#frazer-account-close{float:right}
`;
const markup = `
<div id="frazer-account-shade" role="dialog" aria-modal="true" aria-label="Account and cloud saves">
 <div id="frazer-account-card">
  <button class="secondary" id="frazer-account-close" type="button">Close</button>
  <h2>Frazer Games Account</h2>
  <p>Sign in or create an account to sync compatible game saves across devices.</p>
  <div id="frazer-account-signedout">
   <input id="frazer-account-email" type="email" autocomplete="email" placeholder="Email address">
   <input id="frazer-account-password" type="password" autocomplete="current-password" placeholder="Password (at least 6 characters)">
   <button class="primary" id="frazer-account-signin" type="button">Log in</button>
   <div id="frazer-account-actions">
    <button class="secondary" id="frazer-account-signup" type="button">Create account</button>
   </div>
  </div>
  <div id="frazer-account-signedin" hidden>
   <p id="frazer-account-user"></p>
   <p>Cloud save sync is enabled for compatible localStorage-based game saves.</p>
   <button class="primary" id="frazer-account-sync" type="button">Sync saves now</button>
   <button class="secondary" id="frazer-account-logout" type="button" style="width:100%;margin-top:8px">Log out</button>
  </div>
  <div id="frazer-account-message" aria-live="polite"></div>
 </div>
</div>`;
const style = document.createElement("style");
style.textContent = STYLE;
document.head.appendChild(style);
document.body.insertAdjacentHTML("beforeend", markup);

const $ = id => document.getElementById(id);
const shade = $("frazer-account-shade");
const message = $("frazer-account-message");
let activeUser = null;
let syncTimer = null;
let isApplyingCloud = false;

window.openFrazerAccount = () => {
  shade.style.display = "flex";
  message.textContent = "";
  refreshAccountUI();
};
$("frazer-account-close").addEventListener("click", () => shade.style.display = "none");
shade.addEventListener("click", e => { if (e.target === shade) shade.style.display = "none"; });

function refreshAccountUI() {
  $("frazer-account-signedout").hidden = !!activeUser;
  $("frazer-account-signedin").hidden = !activeUser;
  if (activeUser) $("frazer-account-user").textContent = `Signed in as ${activeUser.email || "your account"}`;
}
function setMessage(text) { message.textContent = text || ""; }

$("frazer-account-signin").addEventListener("click", async () => {
  const email = $("frazer-account-email").value.trim();
  const password = $("frazer-account-password").value;
  if (!email || !password) return setMessage("Enter your email and password.");
  setMessage("Logging in…");
  const { error } = await supabase.auth.signInWithPassword({ email, password });
  setMessage(error ? error.message : "Logged in. Syncing saves…");
});
$("frazer-account-signup").addEventListener("click", async () => {
  const email = $("frazer-account-email").value.trim();
  const password = $("frazer-account-password").value;
  if (!email || !password) return setMessage("Enter your email and password.");
  if (password.length < 6) return setMessage("Use a password with at least 6 characters.");
  setMessage("Creating account…");
  const { data, error } = await supabase.auth.signUp({ email, password });
  if (error) return setMessage(error.message);
  if (!data.session) return setMessage("Account created. Check your email to confirm it, then log in.");
  setMessage("Account created. Syncing saves…");
});
$("frazer-account-logout").addEventListener("click", async () => {
  const { error } = await supabase.auth.signOut();
  setMessage(error ? error.message : "Logged out.");
});
$("frazer-account-sync").addEventListener("click", async () => {
  if (!activeUser) return;
  setMessage("Syncing saves…");
  try { await syncAllSaves(); setMessage("Save sync complete."); }
  catch (e) { setMessage(`Sync failed: ${e.message || e}`); }
});

function isGameSaveKey(key) {
  const k = String(key || "").toLowerCase();
  if (!k) return false;
  // Keep Frazer OS settings, presence identity, Firebase data, and auth tokens private to this device/session.
  if (k.startsWith("frazer")) return false;
  if (k.startsWith("sb-") || k.includes("supabase") || k.includes("firebase")) return false;
  if (k.startsWith("google") || k.startsWith("gsi_")) return false;
  if (k.startsWith("frazercloudstamp:")) return false;
  return true;
}
function stampKey(key) { return `frazerCloudStamp:${key}`; }
function getLocalStamp(key) { return Number(localStorage.getItem(stampKey(key)) || 0); }

async function syncAllSaves() {
  if (!activeUser || isApplyingCloud) return;
  const { data: remoteRows, error } = await supabase
    .from("game_saves")
    .select("save_key,save_data,updated_at")
    .eq("user_id", activeUser.id);
  if (error) throw error;

  const remote = new Map((remoteRows || []).map(row => [row.save_key, row]));
  const localKeys = [];
  for (let i = 0; i < localStorage.length; i++) {
    const key = localStorage.key(i);
    if (isGameSaveKey(key)) localKeys.push(key);
  }

  const upload = [];
  isApplyingCloud = true;
  try {
    for (const key of localKeys) {
      const value = localStorage.getItem(key);
      const localStamp = getLocalStamp(key);
      const row = remote.get(key);
      if (!row) {
        upload.push({ user_id: activeUser.id, save_key: key, save_data: { value, updatedAt: Date.now() } });
      } else {
        const remoteStamp = Number(row.save_data?.updatedAt || Date.parse(row.updated_at) || 0);
        if (remoteStamp > localStamp) {
          localStorage.setItem(key, String(row.save_data?.value ?? ""));
          localStorage.setItem(stampKey(key), String(remoteStamp));
        } else {
          upload.push({ user_id: activeUser.id, save_key: key, save_data: { value, updatedAt: Math.max(Date.now(), localStamp) } });
        }
      }
    }
    const localSet = new Set(localKeys);
    for (const [key, row] of remote) {
      if (!localSet.has(key) && isGameSaveKey(key)) {
        localStorage.setItem(key, String(row.save_data?.value ?? ""));
        localStorage.setItem(stampKey(key), String(Number(row.save_data?.updatedAt || Date.parse(row.updated_at) || Date.now())));
      }
    }
  } finally {
    isApplyingCloud = false;
  }
  if (upload.length) {
    const { error: upsertError } = await supabase.from("game_saves").upsert(upload, { onConflict: "user_id,save_key" });
    if (upsertError) throw upsertError;
    for (const row of upload) localStorage.setItem(stampKey(row.save_key), String(row.save_data.updatedAt));
  }
}

function scheduleSaveSync(key) {
  if (!activeUser || isApplyingCloud || !isGameSaveKey(key)) return;
  clearTimeout(syncTimer);
  syncTimer = setTimeout(async () => {
    try {
      const value = localStorage.getItem(key);
      const updatedAt = Date.now();
      const { error } = await supabase.from("game_saves").upsert({
        user_id: activeUser.id, save_key: key, save_data: { value, updatedAt }
      }, { onConflict: "user_id,save_key" });
      if (error) throw error;
      localStorage.setItem(stampKey(key), String(updatedAt));
    } catch (e) {
      console.warn("Cloud save sync failed:", e);
      setMessage(`Save sync issue: ${e.message || e}`);
    }
  }, 1200);
}

// Same-origin games in iframes share the site's localStorage. Their writes trigger storage events here.
window.addEventListener("storage", event => {
  if (event.key && isGameSaveKey(event.key)) scheduleSaveSync(event.key);
});
// Also catch writes made by scripts running in the main page.
const originalSetItem = Storage.prototype.setItem;
Storage.prototype.setItem = function(key, value) {
  originalSetItem.call(this, key, value);
  if (this === window.localStorage) scheduleSaveSync(String(key));
};

supabase.auth.onAuthStateChange(async (_event, session) => {
  activeUser = session?.user || null;
  refreshAccountUI();
  if (activeUser) {
    try { await syncAllSaves(); setMessage("Signed in. Cloud saves are synced."); }
    catch (e) { setMessage(`Signed in, but save sync failed: ${e.message || e}`); }
  }
});
const { data: initialSession } = await supabase.auth.getSession();
activeUser = initialSession?.session?.user || null;
refreshAccountUI();
if (activeUser) {
  try { await syncAllSaves(); } catch (e) { console.warn("Initial save sync failed:", e); }
}
