/*! For license information please see app.js.LICENSE.txt */
(() => {
    var t = {
        77: () => {
            document.addEventListener("DOMContentLoaded", function () {
                var t = [].slice.call(document.querySelectorAll("img.lazy-image"));
                if ("IntersectionObserver" in window) {
                    var e = new IntersectionObserver(function (t, n) {
                        t.forEach(function (t) {
                            if (t.isIntersecting) {
                                var n = t.target;
                                n.dataset.src && ((n.src = n.dataset.src), n.classList.remove("lazy-image"), e.unobserve(n));
                            }
                        });
                    });
                    t.forEach(function (t) {
                        e.observe(t);
                    });
                }
            });
        },
        265: () => {
            document.addEventListener("DOMContentLoaded", function () {
                var t = document.body,
                    e = document.getElementById("light-button"),
                    n = document.getElementById("dark-button");
                if (null != e && null != n) {
                    e.addEventListener("click", function (t) {
                        t.preventDefault(), o("light");
                    }),
                        n.addEventListener("click", function (t) {
                            t.preventDefault(), o("dark");
                        });
                    var i = ["light", "dark"];
                    o(window.localStorage.getItem("theme"));
                }
                function o(o) {
                    i.includes(o) &&
                        (window.localStorage.setItem("theme", o),
                            e.classList.remove("active"),
                            n.classList.remove("active"),
                            i.forEach(function (i) {
                                i !== o && t.classList.contains(i) && t.classList.remove(i), "light" == o && e.classList.add("active"), "dark" == o && n.classList.add("active");
                            }),
                            t.classList.contains(o) || t.classList.add(o));
                }
            });
        },
        63: function (t, e, n) {
            !(function (t) {
                "use strict";
                function e(t) {
                    return (e =
                        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                            ? function (t) {
                                return typeof t;
                            }
                            : function (t) {
                                return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t;
                            })(t);
                }
                function i(t, e) {
                    if (!(t instanceof e)) throw new TypeError("Cannot call a class as a function");
                }
                function o(t, e) {
                    for (var n = 0; n < e.length; n++) {
                        var i = e[n];
                        (i.enumerable = i.enumerable || !1), (i.configurable = !0), "value" in i && (i.writable = !0), Object.defineProperty(t, i.key, i);
                    }
                }
                function r(t, e, n) {
                    return e && o(t.prototype, e), n && o(t, n), t;
                }
                function s(t, e, n) {
                    return e in t ? Object.defineProperty(t, e, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : (t[e] = n), t;
                }
                function l(t, e) {
                    var n = Object.keys(t);
                    if (Object.getOwnPropertySymbols) {
                        var i = Object.getOwnPropertySymbols(t);
                        e &&
                            (i = i.filter(function (e) {
                                return Object.getOwnPropertyDescriptor(t, e).enumerable;
                            })),
                            n.push.apply(n, i);
                    }
                    return n;
                }
                function a(t) {
                    for (var e = 1; e < arguments.length; e++) {
                        var n = null != arguments[e] ? arguments[e] : {};
                        e % 2
                            ? l(Object(n), !0).forEach(function (e) {
                                s(t, e, n[e]);
                            })
                            : Object.getOwnPropertyDescriptors
                                ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(n))
                                : l(Object(n)).forEach(function (e) {
                                    Object.defineProperty(t, e, Object.getOwnPropertyDescriptor(n, e));
                                });
                    }
                    return t;
                }
                function c(t) {
                    return (c = Object.setPrototypeOf
                        ? Object.getPrototypeOf
                        : function (t) {
                            return t.__proto__ || Object.getPrototypeOf(t);
                        })(t);
                }
                function u(t, e) {
                    return (u =
                        Object.setPrototypeOf ||
                        function (t, e) {
                            return (t.__proto__ = e), t;
                        })(t, e);
                }
                function f() {
                    if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
                    if (Reflect.construct.sham) return !1;
                    if ("function" == typeof Proxy) return !0;
                    try {
                        return Date.prototype.toString.call(Reflect.construct(Date, [], function () { })), !0;
                    } catch (t) {
                        return !1;
                    }
                }
                function h(t, e, n) {
                    return (h = f()
                        ? Reflect.construct
                        : function (t, e, n) {
                            var i = [null];
                            i.push.apply(i, e);
                            var o = new (Function.bind.apply(t, i))();
                            return n && u(o, n.prototype), o;
                        }).apply(null, arguments);
                }
                function d(t) {
                    if (void 0 === t) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                    return t;
                }
                function p(t, e) {
                    return (
                        (function (t) {
                            if (Array.isArray(t)) return t;
                        })(t) ||
                        (function (t, e) {
                            if ("undefined" != typeof Symbol && Symbol.iterator in Object(t)) {
                                var n = [],
                                    i = !0,
                                    o = !1,
                                    r = void 0;
                                try {
                                    for (var s, l = t[Symbol.iterator](); !(i = (s = l.next()).done) && (n.push(s.value), !e || n.length !== e); i = !0);
                                } catch (t) {
                                    (o = !0), (r = t);
                                } finally {
                                    try {
                                        i || null == l.return || l.return();
                                    } finally {
                                        if (o) throw r;
                                    }
                                }
                                return n;
                            }
                        })(t, e) ||
                        m(t, e) ||
                        (function () {
                            throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
                        })()
                    );
                }
                function v(t) {
                    return (
                        (function (t) {
                            if (Array.isArray(t)) return g(t);
                        })(t) ||
                        (function (t) {
                            if ("undefined" != typeof Symbol && Symbol.iterator in Object(t)) return Array.from(t);
                        })(t) ||
                        m(t) ||
                        (function () {
                            throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
                        })()
                    );
                }
                function m(t, e) {
                    if (t) {
                        if ("string" == typeof t) return g(t, e);
                        var n = Object.prototype.toString.call(t).slice(8, -1);
                        return "Object" === n && t.constructor && (n = t.constructor.name), "Map" === n || "Set" === n ? Array.from(t) : "Arguments" === n || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n) ? g(t, e) : void 0;
                    }
                }
                function g(t, e) {
                    (null == e || e > t.length) && (e = t.length);
                    for (var n = 0, i = new Array(e); n < e; n++) i[n] = t[n];
                    return i;
                }
                function y() { }
                function _(t, e) {
                    for (var n in e) t[n] = e[n];
                    return t;
                }
                function b(t) {
                    return t();
                }
                function w() {
                    return Object.create(null);
                }
                function C(t) {
                    t.forEach(b);
                }
                function k(t) {
                    return "function" == typeof t;
                }
                function x(t, n) {
                    return t != t ? n == n : t !== n || (t && "object" === e(t)) || "function" == typeof t;
                }
                function $(t, e) {
                    t.appendChild(e);
                }
                function E(t, e, n) {
                    t.insertBefore(e, n || null);
                }
                function O(t) {
                    t.parentNode.removeChild(t);
                }
                function S(t) {
                    return document.createElement(t);
                }
                function L(t) {
                    return document.createTextNode(t);
                }
                function T() {
                    return L(" ");
                }
                function P() {
                    return L("");
                }
                function M(t, e, n, i) {
                    return (
                        t.addEventListener(e, n, i),
                        function () {
                            return t.removeEventListener(e, n, i);
                        }
                    );
                }
                function A(t, e, n) {
                    null == n ? t.removeAttribute(e) : t.getAttribute(e) !== n && t.setAttribute(e, n);
                }
                function H(t, e) {
                    (e = "" + e), t.wholeText !== e && (t.data = e);
                }
                var N,
                    R = (function () {
                        function t() {
                            var e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : null;
                            i(this, t), (this.a = e), (this.e = this.n = null);
                        }
                        return (
                            r(t, [
                                {
                                    key: "m",
                                    value: function (t, e) {
                                        var n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : null;
                                        this.e || ((this.e = S(e.nodeName)), (this.t = e), this.h(t)), this.i(n);
                                    },
                                },
                                {
                                    key: "h",
                                    value: function (t) {
                                        (this.e.innerHTML = t), (this.n = Array.from(this.e.childNodes));
                                    },
                                },
                                {
                                    key: "i",
                                    value: function (t) {
                                        for (var e = 0; e < this.n.length; e += 1) E(this.t, this.n[e], t);
                                    },
                                },
                                {
                                    key: "p",
                                    value: function (t) {
                                        this.d(), this.h(t), this.i(this.a);
                                    },
                                },
                                {
                                    key: "d",
                                    value: function () {
                                        this.n.forEach(O);
                                    },
                                },
                            ]),
                            t
                        );
                    })();
                function D(t) {
                    N = t;
                }
                function j() {
                    if (!N) throw new Error("Function called outside component initialization");
                    return N;
                }
                var W = [],
                    Y = [],
                    I = [],
                    X = [],
                    F = Promise.resolve(),
                    B = !1;
                function V() {
                    B || ((B = !0), F.then(Z));
                }
                function U() {
                    return V(), F;
                }
                function z(t) {
                    I.push(t);
                }
                var q = !1,
                    G = new Set();
                function Z() {
                    if (!q) {
                        q = !0;
                        do {
                            for (var t = 0; t < W.length; t += 1) {
                                var e = W[t];
                                D(e), K(e.$$);
                            }
                            for (D(null), W.length = 0; Y.length;) Y.pop()();
                            for (var n = 0; n < I.length; n += 1) {
                                var i = I[n];
                                G.has(i) || (G.add(i), i());
                            }
                            I.length = 0;
                        } while (W.length);
                        for (; X.length;) X.pop()();
                        (B = !1), (q = !1), G.clear();
                    }
                }
                function K(t) {
                    if (null !== t.fragment) {
                        t.update(), C(t.before_update);
                        var e = t.dirty;
                        (t.dirty = [-1]), t.fragment && t.fragment.p(t.ctx, e), t.after_update.forEach(z);
                    }
                }
                var J,
                    Q = new Set();
                function tt() {
                    J = { r: 0, c: [], p: J };
                }
                function et() {
                    J.r || C(J.c), (J = J.p);
                }
                function nt(t, e) {
                    t && t.i && (Q.delete(t), t.i(e));
                }
                function it(t, e, n, i) {
                    if (t && t.o) {
                        if (Q.has(t)) return;
                        Q.add(t),
                            J.c.push(function () {
                                Q.delete(t), i && (n && t.d(1), i());
                            }),
                            t.o(e);
                    }
                }
                var ot = "undefined" != typeof window ? window : "undefined" != typeof globalThis ? globalThis : n.g;
                function rt(t, e) {
                    it(t, 1, 1, function () {
                        e.delete(t.key);
                    });
                }
                function st(t, e, n, i, o, r, s, l, a, c, u, f) {
                    for (var h = t.length, d = r.length, p = h, v = {}; p--;) v[t[p].key] = p;
                    var m = [],
                        g = new Map(),
                        y = new Map();
                    for (p = d; p--;) {
                        var _ = f(o, r, p),
                            b = n(_),
                            w = s.get(b);
                        w ? i && w.p(_, e) : (w = c(b, _)).c(), g.set(b, (m[p] = w)), b in v && y.set(b, Math.abs(p - v[b]));
                    }
                    var C = new Set(),
                        k = new Set();
                    function x(t) {
                        nt(t, 1), t.m(l, u), s.set(t.key, t), (u = t.first), d--;
                    }
                    for (; h && d;) {
                        var $ = m[d - 1],
                            E = t[h - 1],
                            O = $.key,
                            S = E.key;
                        $ === E ? ((u = $.first), h--, d--) : g.has(S) ? (!s.has(O) || C.has(O) ? x($) : k.has(S) ? h-- : y.get(O) > y.get(S) ? (k.add(O), x($)) : (C.add(S), h--)) : (a(E, s), h--);
                    }
                    for (; h--;) {
                        var L = t[h];
                        g.has(L.key) || a(L, s);
                    }
                    for (; d;) x(m[d - 1]);
                    return m;
                }
                function lt(t, e) {
                    for (var n = {}, i = {}, o = { $$scope: 1 }, r = t.length; r--;) {
                        var s = t[r],
                            l = e[r];
                        if (l) {
                            for (var a in s) a in l || (i[a] = 1);
                            for (var c in l) o[c] || ((n[c] = l[c]), (o[c] = 1));
                            t[r] = l;
                        } else for (var u in s) o[u] = 1;
                    }
                    for (var f in i) f in n || (n[f] = void 0);
                    return n;
                }
                function at(t) {
                    return "object" === e(t) && null !== t ? t : {};
                }
                function ct(t) {
                    t && t.c();
                }
                function ut(t, e, n) {
                    var i = t.$$,
                        o = i.fragment,
                        r = i.on_mount,
                        s = i.on_destroy,
                        l = i.after_update;
                    o && o.m(e, n),
                        z(function () {
                            var e = r.map(b).filter(k);
                            s ? s.push.apply(s, v(e)) : C(e), (t.$$.on_mount = []);
                        }),
                        l.forEach(z);
                }
                function ft(t, e) {
                    var n = t.$$;
                    null !== n.fragment && (C(n.on_destroy), n.fragment && n.fragment.d(e), (n.on_destroy = n.fragment = null), (n.ctx = []));
                }
                var ht = (function () {
                    function t() {
                        i(this, t);
                    }
                    return (
                        r(t, [
                            {
                                key: "$destroy",
                                value: function () {
                                    ft(this, 1), (this.$destroy = y);
                                },
                            },
                            {
                                key: "$on",
                                value: function (t, e) {
                                    var n = this.$$.callbacks[t] || (this.$$.callbacks[t] = []);
                                    return (
                                        n.push(e),
                                        function () {
                                            var t = n.indexOf(e);
                                            -1 !== t && n.splice(t, 1);
                                        }
                                    );
                                },
                            },
                            {
                                key: "$set",
                                value: function (t) {
                                    var e;
                                    this.$$set && ((e = t), 0 !== Object.keys(e).length) && ((this.$$.skip_bound = !0), this.$$set(t), (this.$$.skip_bound = !1));
                                },
                            },
                        ]),
                        t
                    );
                })(),
                    dt = (function () {
                        function t(e) {
                            if (
                                (i(this, t),
                                    Object.assign(
                                        this,
                                        {
                                            dir1: null,
                                            dir2: null,
                                            firstpos1: null,
                                            firstpos2: null,
                                            spacing1: 25,
                                            spacing2: 25,
                                            push: "bottom",
                                            maxOpen: 1,
                                            maxStrategy: "wait",
                                            maxClosureCausesWait: !0,
                                            modal: "ish",
                                            modalishFlash: !0,
                                            overlayClose: !0,
                                            overlayClosesPinned: !1,
                                            positioned: !0,
                                            context: (window && document.body) || null,
                                        },
                                        e
                                    ),
                                    "ish" === this.modal && 1 !== this.maxOpen)
                            )
                                throw new Error("A modalish stack must have a maxOpen value of 1.");
                            if ("ish" === this.modal && !this.dir1) throw new Error("A modalish stack must have a direction.");
                            if ("top" === this.push && "ish" === this.modal && "close" !== this.maxStrategy) throw new Error("A modalish stack that pushes to the top must use the close maxStrategy.");
                            (this._noticeHead = { notice: null, prev: null, next: null }),
                                (this._noticeTail = { notice: null, prev: this._noticeHead, next: null }),
                                (this._noticeHead.next = this._noticeTail),
                                (this._noticeMap = new WeakMap()),
                                (this._length = 0),
                                (this._addpos2 = 0),
                                (this._animation = !0),
                                (this._posTimer = null),
                                (this._openNotices = 0),
                                (this._listener = null),
                                (this._overlayOpen = !1),
                                (this._overlayInserted = !1),
                                (this._collapsingModalState = !1),
                                (this._leader = null),
                                (this._leaderOff = null),
                                (this._masking = null),
                                (this._maskingOff = null),
                                (this._swapping = !1),
                                (this._callbacks = {});
                        }
                        return (
                            r(t, [
                                {
                                    key: "forEach",
                                    value: function (t) {
                                        var e,
                                            n = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {},
                                            i = n.start,
                                            o = void 0 === i ? "oldest" : i,
                                            r = n.dir,
                                            s = void 0 === r ? "newer" : r,
                                            l = n.skipModuleHandled,
                                            a = void 0 !== l && l;
                                        if ("head" === o || ("newest" === o && "top" === this.push) || ("oldest" === o && "bottom" === this.push)) e = this._noticeHead.next;
                                        else if ("tail" === o || ("newest" === o && "bottom" === this.push) || ("oldest" === o && "top" === this.push)) e = this._noticeTail.prev;
                                        else {
                                            if (!this._noticeMap.has(o)) throw new Error("Invalid start param.");
                                            e = this._noticeMap.get(o);
                                        }
                                        for (; e.notice;) {
                                            var c = e.notice;
                                            if ("prev" === s || ("top" === this.push && "newer" === s) || ("bottom" === this.push && "older" === s)) e = e.prev;
                                            else {
                                                if (!("next" === s || ("top" === this.push && "older" === s) || ("bottom" === this.push && "newer" === s))) throw new Error("Invalid dir param.");
                                                e = e.next;
                                            }
                                            if (!((a && c.getModuleHandled()) || !1 !== t(c))) break;
                                        }
                                    },
                                },
                                {
                                    key: "close",
                                    value: function (t) {
                                        this.forEach(function (e) {
                                            return e.close(t, !1, !1);
                                        });
                                    },
                                },
                                {
                                    key: "open",
                                    value: function (t) {
                                        this.forEach(function (e) {
                                            return e.open(t);
                                        });
                                    },
                                },
                                {
                                    key: "openLast",
                                    value: function () {
                                        this.forEach(
                                            function (t) {
                                                if (-1 === ["opening", "open", "waiting"].indexOf(t.getState())) return t.open(), !1;
                                            },
                                            { start: "newest", dir: "older" }
                                        );
                                    },
                                },
                                {
                                    key: "swap",
                                    value: function (t, e) {
                                        var n = this,
                                            i = arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
                                            o = arguments.length > 3 && void 0 !== arguments[3] && arguments[3];
                                        return -1 === ["open", "opening", "closing"].indexOf(t.getState())
                                            ? Promise.reject()
                                            : ((this._swapping = e),
                                                t
                                                    .close(i, !1, o)
                                                    .then(function () {
                                                        return e.open(i);
                                                    })
                                                    .finally(function () {
                                                        n._swapping = !1;
                                                    }));
                                    },
                                },
                                {
                                    key: "on",
                                    value: function (t, e) {
                                        var n = this;
                                        return (
                                            t in this._callbacks || (this._callbacks[t] = []),
                                            this._callbacks[t].push(e),
                                            function () {
                                                n._callbacks[t].splice(n._callbacks[t].indexOf(e), 1);
                                            }
                                        );
                                    },
                                },
                                {
                                    key: "fire",
                                    value: function (t) {
                                        var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {};
                                        (e.stack = this),
                                            t in this._callbacks &&
                                            this._callbacks[t].forEach(function (t) {
                                                return t(e);
                                            });
                                    },
                                },
                                {
                                    key: "position",
                                    value: function () {
                                        var t = this;
                                        this.positioned && this._length > 0
                                            ? (this.fire("beforePosition"),
                                                this._resetPositionData(),
                                                this.forEach(
                                                    function (e) {
                                                        t._positionNotice(e);
                                                    },
                                                    { start: "head", dir: "next", skipModuleHandled: !0 }
                                                ),
                                                this.fire("afterPosition"))
                                            : (delete this._nextpos1, delete this._nextpos2);
                                    },
                                },
                                {
                                    key: "queuePosition",
                                    value: function () {
                                        var t = this,
                                            e = arguments.length > 0 && void 0 !== arguments[0] ? arguments[0] : 10;
                                        this._posTimer && clearTimeout(this._posTimer),
                                            (this._posTimer = setTimeout(function () {
                                                return t.position();
                                            }, e));
                                    },
                                },
                                {
                                    key: "_resetPositionData",
                                    value: function () {
                                        (this._nextpos1 = this.firstpos1), (this._nextpos2 = this.firstpos2), (this._addpos2 = 0);
                                    },
                                },
                                {
                                    key: "_positionNotice",
                                    value: function (t) {
                                        var e = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : t === this._masking;
                                        if (this.positioned) {
                                            var n = t.refs.elem;
                                            if (n && (n.classList.contains("pnotify-in") || n.classList.contains("pnotify-initial") || e)) {
                                                var i = [this.firstpos1, this.firstpos2, this._nextpos1, this._nextpos2, this._addpos2],
                                                    o = i[0],
                                                    r = i[1],
                                                    s = i[2],
                                                    l = i[3],
                                                    a = i[4];
                                                n.getBoundingClientRect(), !this._animation || e || this._collapsingModalState ? t._setMoveClass("") : t._setMoveClass("pnotify-move");
                                                var c,
                                                    u = this.context === document.body ? window.innerHeight : this.context.scrollHeight,
                                                    f = this.context === document.body ? window.innerWidth : this.context.scrollWidth;
                                                if (this.dir1) {
                                                    var h;
                                                    switch (((c = { down: "top", up: "bottom", left: "right", right: "left" }[this.dir1]), this.dir1)) {
                                                        case "down":
                                                            h = n.offsetTop;
                                                            break;
                                                        case "up":
                                                            h = u - n.scrollHeight - n.offsetTop;
                                                            break;
                                                        case "left":
                                                            h = f - n.scrollWidth - n.offsetLeft;
                                                            break;
                                                        case "right":
                                                            h = n.offsetLeft;
                                                    }
                                                    null == o && (s = o = h);
                                                }
                                                if (this.dir1 && this.dir2) {
                                                    var d,
                                                        p = { down: "top", up: "bottom", left: "right", right: "left" }[this.dir2];
                                                    switch (this.dir2) {
                                                        case "down":
                                                            d = n.offsetTop;
                                                            break;
                                                        case "up":
                                                            d = u - n.scrollHeight - n.offsetTop;
                                                            break;
                                                        case "left":
                                                            d = f - n.scrollWidth - n.offsetLeft;
                                                            break;
                                                        case "right":
                                                            d = n.offsetLeft;
                                                    }
                                                    if ((null == r && (l = r = d), !e)) {
                                                        var v = s + n.offsetHeight + this.spacing1,
                                                            m = s + n.offsetWidth + this.spacing1;
                                                        ((("down" === this.dir1 || "up" === this.dir1) && v > u) || (("left" === this.dir1 || "right" === this.dir1) && m > f)) && ((s = o), (l += a + this.spacing2), (a = 0));
                                                    }
                                                    switch ((null != l && ((n.style[p] = "".concat(l, "px")), this._animation || n.style[p]), this.dir2)) {
                                                        case "down":
                                                        case "up":
                                                            n.offsetHeight + (parseFloat(n.style.marginTop, 10) || 0) + (parseFloat(n.style.marginBottom, 10) || 0) > a && (a = n.offsetHeight);
                                                            break;
                                                        case "left":
                                                        case "right":
                                                            n.offsetWidth + (parseFloat(n.style.marginLeft, 10) || 0) + (parseFloat(n.style.marginRight, 10) || 0) > a && (a = n.offsetWidth);
                                                    }
                                                } else if (this.dir1) {
                                                    var g, y;
                                                    switch (this.dir1) {
                                                        case "down":
                                                        case "up":
                                                            (y = ["left", "right"]), (g = this.context.scrollWidth / 2 - n.offsetWidth / 2);
                                                            break;
                                                        case "left":
                                                        case "right":
                                                            (y = ["top", "bottom"]), (g = u / 2 - n.offsetHeight / 2);
                                                    }
                                                    (n.style[y[0]] = "".concat(g, "px")), (n.style[y[1]] = "auto"), this._animation || n.style[y[0]];
                                                }
                                                if (this.dir1)
                                                    switch ((null != s && ((n.style[c] = "".concat(s, "px")), this._animation || n.style[c]), this.dir1)) {
                                                        case "down":
                                                        case "up":
                                                            s += n.offsetHeight + this.spacing1;
                                                            break;
                                                        case "left":
                                                        case "right":
                                                            s += n.offsetWidth + this.spacing1;
                                                    }
                                                else {
                                                    var _ = f / 2 - n.offsetWidth / 2,
                                                        b = u / 2 - n.offsetHeight / 2;
                                                    (n.style.left = "".concat(_, "px")), (n.style.top = "".concat(b, "px")), this._animation || n.style.left;
                                                }
                                                e || ((this.firstpos1 = o), (this.firstpos2 = r), (this._nextpos1 = s), (this._nextpos2 = l), (this._addpos2 = a));
                                            }
                                        }
                                    },
                                },
                                {
                                    key: "_addNotice",
                                    value: function (t) {
                                        var e = this;
                                        this.fire("beforeAddNotice", { notice: t });
                                        var n = function () {
                                            if ((e.fire("beforeOpenNotice", { notice: t }), t.getModuleHandled())) e.fire("afterOpenNotice", { notice: t });
                                            else {
                                                if ((e._openNotices++, ("ish" !== e.modal || !e._overlayOpen) && e.maxOpen !== 1 / 0 && e._openNotices > e.maxOpen && "close" === e.maxStrategy)) {
                                                    var n = e._openNotices - e.maxOpen;
                                                    e.forEach(function (t) {
                                                        if (-1 !== ["opening", "open"].indexOf(t.getState())) return t.close(!1, !1, e.maxClosureCausesWait), t === e._leader && e._setLeader(null), !!--n;
                                                    });
                                                }
                                                !0 === e.modal && e._insertOverlay(),
                                                    "ish" !== e.modal || (e._leader && -1 !== ["opening", "open", "closing"].indexOf(e._leader.getState())) || e._setLeader(t),
                                                    "ish" === e.modal && e._overlayOpen && t._preventTimerClose(!0),
                                                    e.fire("afterOpenNotice", { notice: t });
                                            }
                                        },
                                            i = {
                                                notice: t,
                                                prev: null,
                                                next: null,
                                                beforeOpenOff: t.on("pnotify:beforeOpen", n),
                                                afterCloseOff: t.on("pnotify:afterClose", function () {
                                                    if ((e.fire("beforeCloseNotice", { notice: t }), t.getModuleHandled())) e.fire("afterCloseNotice", { notice: t });
                                                    else {
                                                        if (
                                                            (e._openNotices--,
                                                                "ish" === e.modal && t === e._leader && (e._setLeader(null), e._masking && e._setMasking(null)),
                                                                !e._swapping && e.maxOpen !== 1 / 0 && e._openNotices < e.maxOpen)
                                                        ) {
                                                            var n = !1,
                                                                i = function (i) {
                                                                    if (i !== t && "waiting" === i.getState() && (i.open().catch(function () { }), e._openNotices >= e.maxOpen)) return (n = !0), !1;
                                                                };
                                                            "wait" === e.maxStrategy
                                                                ? (e.forEach(i, { start: t, dir: "next" }), n || e.forEach(i, { start: t, dir: "prev" }))
                                                                : "close" === e.maxStrategy && e.maxClosureCausesWait && (e.forEach(i, { start: t, dir: "older" }), n || e.forEach(i, { start: t, dir: "newer" }));
                                                        }
                                                        e._openNotices <= 0 ? ((e._openNotices = 0), e._resetPositionData(), e._overlayOpen && !e._swapping && e._removeOverlay()) : e._collapsingModalState || e.queuePosition(0),
                                                            e.fire("afterCloseNotice", { notice: t });
                                                    }
                                                }),
                                            };
                                        if (
                                            ("top" === this.push
                                                ? ((i.next = this._noticeHead.next), (i.prev = this._noticeHead), (i.next.prev = i), (i.prev.next = i))
                                                : ((i.prev = this._noticeTail.prev), (i.next = this._noticeTail), (i.prev.next = i), (i.next.prev = i)),
                                                this._noticeMap.set(t, i),
                                                this._length++,
                                                this._listener ||
                                                ((this._listener = function () {
                                                    return e.position();
                                                }),
                                                    this.context.addEventListener("pnotify:position", this._listener)),
                                                -1 !== ["open", "opening", "closing"].indexOf(t.getState()))
                                        )
                                            n();
                                        else if ("ish" === this.modal && this.modalishFlash && this._shouldNoticeWait(t))
                                            var o = t.on("pnotify:mount", function () {
                                                o(),
                                                    t._setMasking(!0, !1, function () {
                                                        t._setMasking(!1);
                                                    }),
                                                    e._resetPositionData(),
                                                    e._positionNotice(e._leader),
                                                    window.requestAnimationFrame(function () {
                                                        e._positionNotice(t, !0);
                                                    });
                                            });
                                        this.fire("afterAddNotice", { notice: t });
                                    },
                                },
                                {
                                    key: "_removeNotice",
                                    value: function (t) {
                                        if (this._noticeMap.has(t)) {
                                            this.fire("beforeRemoveNotice", { notice: t });
                                            var e = this._noticeMap.get(t);
                                            this._leader === t && this._setLeader(null),
                                                this._masking === t && this._setMasking(null),
                                                (e.prev.next = e.next),
                                                (e.next.prev = e.prev),
                                                (e.prev = null),
                                                (e.next = null),
                                                e.beforeOpenOff(),
                                                (e.beforeOpenOff = null),
                                                e.afterCloseOff(),
                                                (e.afterCloseOff = null),
                                                this._noticeMap.delete(t),
                                                this._length--,
                                                !this._length && this._listener && (this.context.removeEventListener("pnotify:position", this._listener), (this._listener = null)),
                                                !this._length && this._overlayOpen && this._removeOverlay(),
                                                -1 !== ["open", "opening", "closing"].indexOf(t.getState()) && this._handleNoticeClosed(t),
                                                this.fire("afterRemoveNotice", { notice: t });
                                        }
                                    },
                                },
                                {
                                    key: "_setLeader",
                                    value: function (t) {
                                        var e = this;
                                        if ((this.fire("beforeSetLeader", { leader: t }), this._leaderOff && (this._leaderOff(), (this._leaderOff = null)), (this._leader = t), this._leader)) {
                                            var n,
                                                i = function () {
                                                    var t = null;
                                                    e._overlayOpen &&
                                                        ((e._collapsingModalState = !0),
                                                            e.forEach(
                                                                function (n) {
                                                                    n._preventTimerClose(!1), n !== e._leader && -1 !== ["opening", "open"].indexOf(n.getState()) && (t || (t = n), n.close(n === t, !1, !0));
                                                                },
                                                                { start: e._leader, dir: "next", skipModuleHandled: !0 }
                                                            ),
                                                            e._removeOverlay()),
                                                        o && (clearTimeout(o), (o = null)),
                                                        e.forEach(
                                                            function (n) {
                                                                if (n !== e._leader) return "waiting" === n.getState() || n === t ? (e._setMasking(n, !!t), !1) : void 0;
                                                            },
                                                            { start: e._leader, dir: "next", skipModuleHandled: !0 }
                                                        );
                                                },
                                                o = null,
                                                r = function () {
                                                    o && (clearTimeout(o), (o = null)),
                                                        (o = setTimeout(function () {
                                                            (o = null), e._setMasking(null);
                                                        }, 750));
                                                };
                                            (this._leaderOff =
                                                ((n = [this._leader.on("mouseenter", i), this._leader.on("focusin", i), this._leader.on("mouseleave", r), this._leader.on("focusout", r)]),
                                                    function () {
                                                        return n.map(function (t) {
                                                            return t();
                                                        });
                                                    })),
                                                this.fire("afterSetLeader", { leader: t });
                                        } else this.fire("afterSetLeader", { leader: t });
                                    },
                                },
                                {
                                    key: "_setMasking",
                                    value: function (t, e) {
                                        var n = this;
                                        if (this._masking) {
                                            if (this._masking === t) return;
                                            this._masking._setMasking(!1, e);
                                        }
                                        if ((this._maskingOff && (this._maskingOff(), (this._maskingOff = null)), (this._masking = t), this._masking)) {
                                            this._resetPositionData(),
                                                this._leader && this._positionNotice(this._leader),
                                                this._masking._setMasking(!0, e),
                                                window.requestAnimationFrame(function () {
                                                    n._masking && n._positionNotice(n._masking);
                                                });
                                            var i,
                                                o = function () {
                                                    "ish" === n.modal &&
                                                        (n._insertOverlay(),
                                                            n._setMasking(null, !0),
                                                            n.forEach(
                                                                function (t) {
                                                                    t._preventTimerClose(!0), "waiting" === t.getState() && t.open();
                                                                },
                                                                { start: n._leader, dir: "next", skipModuleHandled: !0 }
                                                            ));
                                                };
                                            this._maskingOff =
                                                ((i = [this._masking.on("mouseenter", o), this._masking.on("focusin", o)]),
                                                    function () {
                                                        return i.map(function (t) {
                                                            return t();
                                                        });
                                                    });
                                        }
                                    },
                                },
                                {
                                    key: "_shouldNoticeWait",
                                    value: function (t) {
                                        return this._swapping !== t && !("ish" === this.modal && this._overlayOpen) && this.maxOpen !== 1 / 0 && this._openNotices >= this.maxOpen && "wait" === this.maxStrategy;
                                    },
                                },
                                {
                                    key: "_insertOverlay",
                                    value: function () {
                                        var t = this;
                                        this._overlay ||
                                            ((this._overlay = document.createElement("div")),
                                                this._overlay.classList.add("pnotify-modal-overlay"),
                                                this.dir1 && this._overlay.classList.add("pnotify-modal-overlay-".concat(this.dir1)),
                                                this.overlayClose && this._overlay.classList.add("pnotify-modal-overlay-closes"),
                                                this.context !== document.body && ((this._overlay.style.height = "".concat(this.context.scrollHeight, "px")), (this._overlay.style.width = "".concat(this.context.scrollWidth, "px"))),
                                                this._overlay.addEventListener("click", function (e) {
                                                    if (t.overlayClose) {
                                                        if ((t.fire("overlayClose", { clickEvent: e }), e.defaultPrevented)) return;
                                                        t._leader && t._setLeader(null),
                                                            t.forEach(
                                                                function (e) {
                                                                    -1 === ["closed", "closing", "waiting"].indexOf(e.getState()) &&
                                                                        (e.hide || t.overlayClosesPinned ? e.close() : e.hide || "ish" !== t.modal || (t._leader ? e.close(!1, !1, !0) : t._setLeader(e)));
                                                                },
                                                                { skipModuleHandled: !0 }
                                                            ),
                                                            t._overlayOpen && t._removeOverlay();
                                                    }
                                                })),
                                            this._overlay.parentNode !== this.context &&
                                            (this.fire("beforeAddOverlay"),
                                                this._overlay.classList.remove("pnotify-modal-overlay-in"),
                                                (this._overlay = this.context.insertBefore(this._overlay, this.context.firstChild)),
                                                (this._overlayOpen = !0),
                                                (this._overlayInserted = !0),
                                                window.requestAnimationFrame(function () {
                                                    t._overlay.classList.add("pnotify-modal-overlay-in"), t.fire("afterAddOverlay");
                                                })),
                                            (this._collapsingModalState = !1);
                                    },
                                },
                                {
                                    key: "_removeOverlay",
                                    value: function () {
                                        var t = this;
                                        this._overlay.parentNode &&
                                            (this.fire("beforeRemoveOverlay"),
                                                this._overlay.classList.remove("pnotify-modal-overlay-in"),
                                                (this._overlayOpen = !1),
                                                setTimeout(function () {
                                                    (t._overlayInserted = !1), t._overlay.parentNode && (t._overlay.parentNode.removeChild(t._overlay), t.fire("afterRemoveOverlay"));
                                                }, 250),
                                                setTimeout(function () {
                                                    t._collapsingModalState = !1;
                                                }, 400));
                                    },
                                },
                                {
                                    key: "notices",
                                    get: function () {
                                        var t = [];
                                        return (
                                            this.forEach(function (e) {
                                                return t.push(e);
                                            }),
                                            t
                                        );
                                    },
                                },
                                {
                                    key: "length",
                                    get: function () {
                                        return this._length;
                                    },
                                },
                                {
                                    key: "leader",
                                    get: function () {
                                        return this._leader;
                                    },
                                },
                            ]),
                            t
                        );
                    })(),
                    pt = function () {
                        for (var t = arguments.length, e = new Array(t), n = 0; n < t; n++) e[n] = arguments[n];
                        return h(Ft, e);
                    },
                    vt = ot.Map;
                function mt(t, e, n) {
                    var i = t.slice();
                    return (i[109] = e[n][0]), (i[110] = e[n][1]), i;
                }
                function gt(t, e, n) {
                    var i = t.slice();
                    return (i[109] = e[n][0]), (i[110] = e[n][1]), i;
                }
                function yt(t, e, n) {
                    var i = t.slice();
                    return (i[109] = e[n][0]), (i[110] = e[n][1]), i;
                }
                function _t(t, e, n) {
                    var i = t.slice();
                    return (i[109] = e[n][0]), (i[110] = e[n][1]), i;
                }
                function bt(t, e) {
                    var n,
                        i,
                        o,
                        r,
                        s = [{ self: e[42] }, e[110]],
                        l = e[109].default;
                    function a(t) {
                        for (var e = {}, n = 0; n < s.length; n += 1) e = _(e, s[n]);
                        return { props: e };
                    }
                    return (
                        l && (i = new l(a())),
                        {
                            key: t,
                            first: null,
                            c: function () {
                                (n = P()), i && ct(i.$$.fragment), (o = P()), (this.first = n);
                            },
                            m: function (t, e) {
                                E(t, n, e), i && ut(i, t, e), E(t, o, e), (r = !0);
                            },
                            p: function (t, e) {
                                var n = 2176 & e[1] ? lt(s, [2048 & e[1] && { self: t[42] }, 128 & e[1] && at(t[110])]) : {};
                                if (l !== (l = t[109].default)) {
                                    if (i) {
                                        tt();
                                        var r = i;
                                        it(r.$$.fragment, 1, 0, function () {
                                            ft(r, 1);
                                        }),
                                            et();
                                    }
                                    l ? (ct((i = new l(a())).$$.fragment), nt(i.$$.fragment, 1), ut(i, o.parentNode, o)) : (i = null);
                                } else l && i.$set(n);
                            },
                            i: function (t) {
                                r || (i && nt(i.$$.fragment, t), (r = !0));
                            },
                            o: function (t) {
                                i && it(i.$$.fragment, t), (r = !1);
                            },
                            d: function (t) {
                                t && O(n), t && O(o), i && ft(i, t);
                            },
                        }
                    );
                }
                function wt(t) {
                    var e, n, i, o, r, s;
                    return {
                        c: function () {
                            (e = S("div")),
                                A((n = S("span")), "class", t[22]("closer")),
                                A(e, "class", (i = "pnotify-closer ".concat(t[21]("closer"), " ").concat((t[17] && !t[26]) || t[28] ? "pnotify-hidden" : ""))),
                                A(e, "role", "button"),
                                A(e, "tabindex", "0"),
                                A(e, "title", (o = t[20].close));
                        },
                        m: function (i, o) {
                            E(i, e, o), $(e, n), r || ((s = M(e, "click", t[81])), (r = !0));
                        },
                        p: function (t, n) {
                            335675392 & n[0] && i !== (i = "pnotify-closer ".concat(t[21]("closer"), " ").concat((t[17] && !t[26]) || t[28] ? "pnotify-hidden" : "")) && A(e, "class", i),
                                1048576 & n[0] && o !== (o = t[20].close) && A(e, "title", o);
                        },
                        d: function (t) {
                            t && O(e), (r = !1), s();
                        },
                    };
                }
                function Ct(t) {
                    var e, n, i, o, r, s, l, a;
                    return {
                        c: function () {
                            (e = S("div")),
                                A((n = S("span")), "class", (i = "".concat(t[22]("sticker"), " ").concat(t[3] ? t[22]("unstuck") : t[22]("stuck")))),
                                A(e, "class", (o = "pnotify-sticker ".concat(t[21]("sticker"), " ").concat((t[19] && !t[26]) || t[28] ? "pnotify-hidden" : ""))),
                                A(e, "role", "button"),
                                A(e, "aria-pressed", (r = !t[3])),
                                A(e, "tabindex", "0"),
                                A(e, "title", (s = t[3] ? t[20].stick : t[20].unstick));
                        },
                        m: function (i, o) {
                            E(i, e, o), $(e, n), l || ((a = M(e, "click", t[82])), (l = !0));
                        },
                        p: function (t, l) {
                            8 & l[0] && i !== (i = "".concat(t[22]("sticker"), " ").concat(t[3] ? t[22]("unstuck") : t[22]("stuck"))) && A(n, "class", i),
                                336068608 & l[0] && o !== (o = "pnotify-sticker ".concat(t[21]("sticker"), " ").concat((t[19] && !t[26]) || t[28] ? "pnotify-hidden" : "")) && A(e, "class", o),
                                8 & l[0] && r !== (r = !t[3]) && A(e, "aria-pressed", r),
                                1048584 & l[0] && s !== (s = t[3] ? t[20].stick : t[20].unstick) && A(e, "title", s);
                        },
                        d: function (t) {
                            t && O(e), (l = !1), a();
                        },
                    };
                }
                function kt(t) {
                    var e, n, i;
                    return {
                        c: function () {
                            (e = S("div")), A((n = S("span")), "class", (i = !0 === t[13] ? t[22](t[4]) : t[13])), A(e, "class", "pnotify-icon ".concat(t[21]("icon")));
                        },
                        m: function (i, o) {
                            E(i, e, o), $(e, n), t[83](e);
                        },
                        p: function (t, e) {
                            8208 & e[0] && i !== (i = !0 === t[13] ? t[22](t[4]) : t[13]) && A(n, "class", i);
                        },
                        d: function (n) {
                            n && O(e), t[83](null);
                        },
                    };
                }
                function xt(t, e) {
                    var n,
                        i,
                        o,
                        r,
                        s = [{ self: e[42] }, e[110]],
                        l = e[109].default;
                    function a(t) {
                        for (var e = {}, n = 0; n < s.length; n += 1) e = _(e, s[n]);
                        return { props: e };
                    }
                    return (
                        l && (i = new l(a())),
                        {
                            key: t,
                            first: null,
                            c: function () {
                                (n = P()), i && ct(i.$$.fragment), (o = P()), (this.first = n);
                            },
                            m: function (t, e) {
                                E(t, n, e), i && ut(i, t, e), E(t, o, e), (r = !0);
                            },
                            p: function (t, e) {
                                var n = 2304 & e[1] ? lt(s, [2048 & e[1] && { self: t[42] }, 256 & e[1] && at(t[110])]) : {};
                                if (l !== (l = t[109].default)) {
                                    if (i) {
                                        tt();
                                        var r = i;
                                        it(r.$$.fragment, 1, 0, function () {
                                            ft(r, 1);
                                        }),
                                            et();
                                    }
                                    l ? (ct((i = new l(a())).$$.fragment), nt(i.$$.fragment, 1), ut(i, o.parentNode, o)) : (i = null);
                                } else l && i.$set(n);
                            },
                            i: function (t) {
                                r || (i && nt(i.$$.fragment, t), (r = !0));
                            },
                            o: function (t) {
                                i && it(i.$$.fragment, t), (r = !1);
                            },
                            d: function (t) {
                                t && O(n), t && O(o), i && ft(i, t);
                            },
                        }
                    );
                }
                function $t(t) {
                    var e,
                        n = !t[34] && Et(t);
                    return {
                        c: function () {
                            (e = S("div")), n && n.c(), A(e, "class", "pnotify-title ".concat(t[21]("title")));
                        },
                        m: function (i, o) {
                            E(i, e, o), n && n.m(e, null), t[84](e);
                        },
                        p: function (t, i) {
                            t[34] ? n && (n.d(1), (n = null)) : n ? n.p(t, i) : ((n = Et(t)).c(), n.m(e, null));
                        },
                        d: function (i) {
                            i && O(e), n && n.d(), t[84](null);
                        },
                    };
                }
                function Et(t) {
                    var e;
                    function n(t, e) {
                        return t[6] ? St : Ot;
                    }
                    var i = n(t),
                        o = i(t);
                    return {
                        c: function () {
                            o.c(), (e = P());
                        },
                        m: function (t, n) {
                            o.m(t, n), E(t, e, n);
                        },
                        p: function (t, r) {
                            i === (i = n(t)) && o ? o.p(t, r) : (o.d(1), (o = i(t)) && (o.c(), o.m(e.parentNode, e)));
                        },
                        d: function (t) {
                            o.d(t), t && O(e);
                        },
                    };
                }
                function Ot(t) {
                    var e, n;
                    return {
                        c: function () {
                            (e = S("span")), (n = L(t[5])), A(e, "class", "pnotify-pre-line");
                        },
                        m: function (t, i) {
                            E(t, e, i), $(e, n);
                        },
                        p: function (t, e) {
                            32 & e[0] && H(n, t[5]);
                        },
                        d: function (t) {
                            t && O(e);
                        },
                    };
                }
                function St(t) {
                    var e, n;
                    return {
                        c: function () {
                            (n = P()), (e = new R(n));
                        },
                        m: function (i, o) {
                            e.m(t[5], i, o), E(i, n, o);
                        },
                        p: function (t, n) {
                            32 & n[0] && e.p(t[5]);
                        },
                        d: function (t) {
                            t && O(n), t && e.d();
                        },
                    };
                }
                function Lt(t) {
                    var e,
                        n,
                        i = !t[35] && Tt(t);
                    return {
                        c: function () {
                            (e = S("div")), i && i.c(), A(e, "class", (n = "pnotify-text ".concat(t[21]("text"), " ").concat("" === t[33] ? "" : "pnotify-text-with-max-height"))), A(e, "style", t[33]), A(e, "role", "alert");
                        },
                        m: function (n, o) {
                            E(n, e, o), i && i.m(e, null), t[85](e);
                        },
                        p: function (t, o) {
                            t[35] ? i && (i.d(1), (i = null)) : i ? i.p(t, o) : ((i = Tt(t)).c(), i.m(e, null)),
                                4 & o[1] && n !== (n = "pnotify-text ".concat(t[21]("text"), " ").concat("" === t[33] ? "" : "pnotify-text-with-max-height")) && A(e, "class", n),
                                4 & o[1] && A(e, "style", t[33]);
                        },
                        d: function (n) {
                            n && O(e), i && i.d(), t[85](null);
                        },
                    };
                }
                function Tt(t) {
                    var e;
                    function n(t, e) {
                        return t[8] ? Mt : Pt;
                    }
                    var i = n(t),
                        o = i(t);
                    return {
                        c: function () {
                            o.c(), (e = P());
                        },
                        m: function (t, n) {
                            o.m(t, n), E(t, e, n);
                        },
                        p: function (t, r) {
                            i === (i = n(t)) && o ? o.p(t, r) : (o.d(1), (o = i(t)) && (o.c(), o.m(e.parentNode, e)));
                        },
                        d: function (t) {
                            o.d(t), t && O(e);
                        },
                    };
                }
                function Pt(t) {
                    var e, n;
                    return {
                        c: function () {
                            (e = S("span")), (n = L(t[7])), A(e, "class", "pnotify-pre-line");
                        },
                        m: function (t, i) {
                            E(t, e, i), $(e, n);
                        },
                        p: function (t, e) {
                            128 & e[0] && H(n, t[7]);
                        },
                        d: function (t) {
                            t && O(e);
                        },
                    };
                }
                function Mt(t) {
                    var e, n;
                    return {
                        c: function () {
                            (n = P()), (e = new R(n));
                        },
                        m: function (i, o) {
                            e.m(t[7], i, o), E(i, n, o);
                        },
                        p: function (t, n) {
                            128 & n[0] && e.p(t[7]);
                        },
                        d: function (t) {
                            t && O(n), t && e.d();
                        },
                    };
                }
                function At(t, e) {
                    var n,
                        i,
                        o,
                        r,
                        s = [{ self: e[42] }, e[110]],
                        l = e[109].default;
                    function a(t) {
                        for (var e = {}, n = 0; n < s.length; n += 1) e = _(e, s[n]);
                        return { props: e };
                    }
                    return (
                        l && (i = new l(a())),
                        {
                            key: t,
                            first: null,
                            c: function () {
                                (n = P()), i && ct(i.$$.fragment), (o = P()), (this.first = n);
                            },
                            m: function (t, e) {
                                E(t, n, e), i && ut(i, t, e), E(t, o, e), (r = !0);
                            },
                            p: function (t, e) {
                                var n = 2560 & e[1] ? lt(s, [2048 & e[1] && { self: t[42] }, 512 & e[1] && at(t[110])]) : {};
                                if (l !== (l = t[109].default)) {
                                    if (i) {
                                        tt();
                                        var r = i;
                                        it(r.$$.fragment, 1, 0, function () {
                                            ft(r, 1);
                                        }),
                                            et();
                                    }
                                    l ? (ct((i = new l(a())).$$.fragment), nt(i.$$.fragment, 1), ut(i, o.parentNode, o)) : (i = null);
                                } else l && i.$set(n);
                            },
                            i: function (t) {
                                r || (i && nt(i.$$.fragment, t), (r = !0));
                            },
                            o: function (t) {
                                i && it(i.$$.fragment, t), (r = !1);
                            },
                            d: function (t) {
                                t && O(n), t && O(o), i && ft(i, t);
                            },
                        }
                    );
                }
                function Ht(t, e) {
                    var n,
                        i,
                        o,
                        r,
                        s = [{ self: e[42] }, e[110]],
                        l = e[109].default;
                    function a(t) {
                        for (var e = {}, n = 0; n < s.length; n += 1) e = _(e, s[n]);
                        return { props: e };
                    }
                    return (
                        l && (i = new l(a())),
                        {
                            key: t,
                            first: null,
                            c: function () {
                                (n = P()), i && ct(i.$$.fragment), (o = P()), (this.first = n);
                            },
                            m: function (t, e) {
                                E(t, n, e), i && ut(i, t, e), E(t, o, e), (r = !0);
                            },
                            p: function (t, e) {
                                var n = 3072 & e[1] ? lt(s, [2048 & e[1] && { self: t[42] }, 1024 & e[1] && at(t[110])]) : {};
                                if (l !== (l = t[109].default)) {
                                    if (i) {
                                        tt();
                                        var r = i;
                                        it(r.$$.fragment, 1, 0, function () {
                                            ft(r, 1);
                                        }),
                                            et();
                                    }
                                    l ? (ct((i = new l(a())).$$.fragment), nt(i.$$.fragment, 1), ut(i, o.parentNode, o)) : (i = null);
                                } else l && i.$set(n);
                            },
                            i: function (t) {
                                r || (i && nt(i.$$.fragment, t), (r = !0));
                            },
                            o: function (t) {
                                i && it(i.$$.fragment, t), (r = !1);
                            },
                            d: function (t) {
                                t && O(n), t && O(o), i && ft(i, t);
                            },
                        }
                    );
                }
                function Nt(t) {
                    for (
                        var e,
                        n,
                        i,
                        o,
                        r,
                        s,
                        l,
                        a,
                        c,
                        u,
                        f,
                        h,
                        d,
                        p,
                        v,
                        m,
                        g,
                        _ = [],
                        b = new vt(),
                        w = [],
                        x = new vt(),
                        L = [],
                        P = new vt(),
                        H = [],
                        N = new vt(),
                        R = t[38],
                        D = function (t) {
                            return t[109];
                        },
                        j = 0;
                        j < R.length;
                        j += 1
                    ) {
                        var W = _t(t, R, j),
                            Y = D(W);
                        b.set(Y, (_[j] = bt(Y, W)));
                    }
                    for (
                        var I = t[16] && !t[36] && wt(t),
                        X = t[18] && !t[36] && Ct(t),
                        F = !1 !== t[13] && kt(t),
                        B = t[39],
                        V = function (t) {
                            return t[109];
                        },
                        U = 0;
                        U < B.length;
                        U += 1
                    ) {
                        var z = yt(t, B, U),
                            q = V(z);
                        x.set(q, (w[U] = xt(q, z)));
                    }
                    for (
                        var G = !1 !== t[5] && $t(t),
                        Z = !1 !== t[7] && Lt(t),
                        K = t[40],
                        J = function (t) {
                            return t[109];
                        },
                        Q = 0;
                        Q < K.length;
                        Q += 1
                    ) {
                        var ot = gt(t, K, Q),
                            lt = J(ot);
                        P.set(lt, (L[Q] = At(lt, ot)));
                    }
                    for (
                        var at = t[41],
                        ct = function (t) {
                            return t[109];
                        },
                        ut = 0;
                        ut < at.length;
                        ut += 1
                    ) {
                        var ft = mt(t, at, ut),
                            ht = ct(ft);
                        N.set(ht, (H[ut] = Ht(ht, ft)));
                    }
                    return {
                        c: function () {
                            (e = S("div")), (n = S("div"));
                            for (var v = 0; v < _.length; v += 1) _[v].c();
                            (i = T()), I && I.c(), (o = T()), X && X.c(), (r = T()), F && F.c(), (s = T()), (l = S("div"));
                            for (var m = 0; m < w.length; m += 1) w[m].c();
                            (a = T()), G && G.c(), (c = T()), Z && Z.c(), (u = T());
                            for (var g = 0; g < L.length; g += 1) L[g].c();
                            f = T();
                            for (var y = 0; y < H.length; y += 1) H[y].c();
                            A(l, "class", "pnotify-content ".concat(t[21]("content"))),
                                A(
                                    n,
                                    "class",
                                    (h = "pnotify-container "
                                        .concat(t[21]("container"), " ")
                                        .concat(t[21](t[4]), " ")
                                        .concat(t[15] ? "pnotify-shadow" : "", " ")
                                        .concat(t[27].container.join(" ")))
                                ),
                                A(n, "style", (d = "".concat(t[31], " ").concat(t[32]))),
                                A(n, "role", "alert"),
                                A(e, "data-pnotify", ""),
                                A(
                                    e,
                                    "class",
                                    (p = "pnotify "
                                        .concat(!t[0] || t[0].positioned ? "pnotify-positioned" : "", " ")
                                        .concat(!1 !== t[13] ? "pnotify-with-icon" : "", " ")
                                        .concat(t[21]("elem"), " pnotify-mode-")
                                        .concat(t[9], " ")
                                        .concat(t[10], " ")
                                        .concat(t[24], " ")
                                        .concat(t[25], " ")
                                        .concat(t[37], " ")
                                        .concat("fade" === t[2] ? "pnotify-fade-".concat(t[14]) : "", " ")
                                        .concat(t[30] ? "pnotify-modal ".concat(t[11]) : t[12], " ")
                                        .concat(t[28] ? "pnotify-masking" : "", " ")
                                        .concat(t[29] ? "pnotify-masking-in" : "", " ")
                                        .concat(t[27].elem.join(" ")))
                                ),
                                A(e, "aria-live", "assertive"),
                                A(e, "role", "alertdialog");
                        },
                        m: function (h, d) {
                            E(h, e, d), $(e, n);
                            for (var p = 0; p < _.length; p += 1) _[p].m(n, null);
                            $(n, i), I && I.m(n, null), $(n, o), X && X.m(n, null), $(n, r), F && F.m(n, null), $(n, s), $(n, l);
                            for (var b = 0; b < w.length; b += 1) w[b].m(l, null);
                            $(l, a), G && G.m(l, null), $(l, c), Z && Z.m(l, null), $(l, u);
                            for (var C = 0; C < L.length; C += 1) L[C].m(l, null);
                            t[86](l), $(n, f);
                            for (var x = 0; x < H.length; x += 1) H[x].m(n, null);
                            var O;
                            t[87](n),
                                t[88](e),
                                (v = !0),
                                m || ((g = [((O = t[43].call(null, e)), O && k(O.destroy) ? O.destroy : y), M(e, "mouseenter", t[44]), M(e, "mouseleave", t[45]), M(e, "focusin", t[44]), M(e, "focusout", t[45])]), (m = !0));
                        },
                        p: function (t, f) {
                            if (2176 & f[1]) {
                                var m = t[38];
                                tt(), (_ = st(_, f, D, 1, t, m, b, n, rt, bt, i, _t)), et();
                            }
                            if (
                                (t[16] && !t[36] ? (I ? I.p(t, f) : ((I = wt(t)).c(), I.m(n, o))) : I && (I.d(1), (I = null)),
                                    t[18] && !t[36] ? (X ? X.p(t, f) : ((X = Ct(t)).c(), X.m(n, r))) : X && (X.d(1), (X = null)),
                                    !1 !== t[13] ? (F ? F.p(t, f) : ((F = kt(t)).c(), F.m(n, s))) : F && (F.d(1), (F = null)),
                                    2304 & f[1])
                            ) {
                                var g = t[39];
                                tt(), (w = st(w, f, V, 1, t, g, x, l, rt, xt, a, yt)), et();
                            }
                            if ((!1 !== t[5] ? (G ? G.p(t, f) : ((G = $t(t)).c(), G.m(l, c))) : G && (G.d(1), (G = null)), !1 !== t[7] ? (Z ? Z.p(t, f) : ((Z = Lt(t)).c(), Z.m(l, u))) : Z && (Z.d(1), (Z = null)), 2560 & f[1])) {
                                var y = t[40];
                                tt(), (L = st(L, f, J, 1, t, y, P, l, rt, At, null, gt)), et();
                            }
                            if (3072 & f[1]) {
                                var C = t[41];
                                tt(), (H = st(H, f, ct, 1, t, C, N, n, rt, Ht, null, mt)), et();
                            }
                            (!v ||
                                (134250512 & f[0] &&
                                    h !==
                                    (h = "pnotify-container "
                                        .concat(t[21]("container"), " ")
                                        .concat(t[21](t[4]), " ")
                                        .concat(t[15] ? "pnotify-shadow" : "", " ")
                                        .concat(t[27].container.join(" "))))) &&
                                A(n, "class", h),
                                (!v || (3 & f[1] && d !== (d = "".concat(t[31], " ").concat(t[32])))) && A(n, "style", d),
                                (!v ||
                                    ((2063629829 & f[0]) | (64 & f[1]) &&
                                        p !==
                                        (p = "pnotify "
                                            .concat(!t[0] || t[0].positioned ? "pnotify-positioned" : "", " ")
                                            .concat(!1 !== t[13] ? "pnotify-with-icon" : "", " ")
                                            .concat(t[21]("elem"), " pnotify-mode-")
                                            .concat(t[9], " ")
                                            .concat(t[10], " ")
                                            .concat(t[24], " ")
                                            .concat(t[25], " ")
                                            .concat(t[37], " ")
                                            .concat("fade" === t[2] ? "pnotify-fade-".concat(t[14]) : "", " ")
                                            .concat(t[30] ? "pnotify-modal ".concat(t[11]) : t[12], " ")
                                            .concat(t[28] ? "pnotify-masking" : "", " ")
                                            .concat(t[29] ? "pnotify-masking-in" : "", " ")
                                            .concat(t[27].elem.join(" "))))) &&
                                A(e, "class", p);
                        },
                        i: function (t) {
                            if (!v) {
                                for (var e = 0; e < R.length; e += 1) nt(_[e]);
                                for (var n = 0; n < B.length; n += 1) nt(w[n]);
                                for (var i = 0; i < K.length; i += 1) nt(L[i]);
                                for (var o = 0; o < at.length; o += 1) nt(H[o]);
                                v = !0;
                            }
                        },
                        o: function (t) {
                            for (var e = 0; e < _.length; e += 1) it(_[e]);
                            for (var n = 0; n < w.length; n += 1) it(w[n]);
                            for (var i = 0; i < L.length; i += 1) it(L[i]);
                            for (var o = 0; o < H.length; o += 1) it(H[o]);
                            v = !1;
                        },
                        d: function (n) {
                            n && O(e);
                            for (var i = 0; i < _.length; i += 1) _[i].d();
                            I && I.d(), X && X.d(), F && F.d();
                            for (var o = 0; o < w.length; o += 1) w[o].d();
                            G && G.d(), Z && Z.d();
                            for (var r = 0; r < L.length; r += 1) L[r].d();
                            t[86](null);
                            for (var s = 0; s < H.length; s += 1) H[s].d();
                            t[87](null), t[88](null), (m = !1), C(g);
                        },
                    };
                }
                function Rt(t, n) {
                    "object" !== e(t) && (t = { text: t }), n && (t.type = n);
                    var i = document.body;
                    return "stack" in t && t.stack && t.stack.context && (i = t.stack.context), { target: i, props: t };
                }
                var Dt,
                    jt = new dt({ dir1: "down", dir2: "left", firstpos1: 25, firstpos2: 25, spacing1: 36, spacing2: 36, push: "bottom" }),
                    Wt = new Map(),
                    Yt = {
                        type: "notice",
                        title: !1,
                        titleTrusted: !1,
                        text: !1,
                        textTrusted: !1,
                        styling: "brighttheme",
                        icons: "brighttheme",
                        mode: "no-preference",
                        addClass: "",
                        addModalClass: "",
                        addModelessClass: "",
                        autoOpen: !0,
                        width: "360px",
                        minHeight: "16px",
                        maxTextHeight: "200px",
                        icon: !0,
                        animation: "fade",
                        animateSpeed: "normal",
                        shadow: !0,
                        hide: !0,
                        delay: 8e3,
                        mouseReset: !0,
                        closer: !0,
                        closerHover: !0,
                        sticker: !0,
                        stickerHover: !0,
                        labels: { close: "Close", stick: "Pin", unstick: "Unpin" },
                        remove: !0,
                        destroy: !0,
                        stack: jt,
                        modules: Wt,
                    };
                function It() {
                    jt.context || (jt.context = document.body),
                        window.addEventListener("resize", function () {
                            Dt && clearTimeout(Dt),
                                (Dt = setTimeout(function () {
                                    var t = new Event("pnotify:position");
                                    document.body.dispatchEvent(t), (Dt = null);
                                }, 10));
                        });
                }
                function Xt(t, e, n) {
                    var i = j(),
                        o = (function () {
                            var t = j();
                            return function (e, n) {
                                var i = t.$$.callbacks[e];
                                if (i) {
                                    var o = (function (t, e) {
                                        var n = document.createEvent("CustomEvent");
                                        return n.initCustomEvent(t, !1, !1, e), n;
                                    })(e, n);
                                    i.slice().forEach(function (e) {
                                        e.call(t, o);
                                    });
                                }
                            };
                        })(),
                        r = (function (t) {
                            var e = [
                                "focus",
                                "blur",
                                "fullscreenchange",
                                "fullscreenerror",
                                "scroll",
                                "cut",
                                "copy",
                                "paste",
                                "keydown",
                                "keypress",
                                "keyup",
                                "auxclick",
                                "click",
                                "contextmenu",
                                "dblclick",
                                "mousedown",
                                "mouseenter",
                                "mouseleave",
                                "mousemove",
                                "mouseover",
                                "mouseout",
                                "mouseup",
                                "pointerlockchange",
                                "pointerlockerror",
                                "select",
                                "wheel",
                                "drag",
                                "dragend",
                                "dragenter",
                                "dragstart",
                                "dragleave",
                                "dragover",
                                "drop",
                                "touchcancel",
                                "touchend",
                                "touchmove",
                                "touchstart",
                                "pointerover",
                                "pointerenter",
                                "pointerdown",
                                "pointermove",
                                "pointerup",
                                "pointercancel",
                                "pointerout",
                                "pointerleave",
                                "gotpointercapture",
                                "lostpointercapture",
                            ].concat(v(arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : []));
                            function n(e) {
                                !(function (t, e) {
                                    var n = t.$$.callbacks[e.type];
                                    n &&
                                        n.slice().forEach(function (t) {
                                            return t(e);
                                        });
                                })(t, e);
                            }
                            return function (t) {
                                for (var i = [], o = 0; o < e.length; o++) i.push(M(t, e[o], n));
                                return {
                                    destroy: function () {
                                        for (var t = 0; t < i.length; t++) i[t]();
                                    },
                                };
                            };
                        })(i, [
                            "pnotify:init",
                            "pnotify:mount",
                            "pnotify:update",
                            "pnotify:beforeOpen",
                            "pnotify:afterOpen",
                            "pnotify:enterModal",
                            "pnotify:leaveModal",
                            "pnotify:beforeClose",
                            "pnotify:afterClose",
                            "pnotify:beforeDestroy",
                            "pnotify:afterDestroy",
                            "focusin",
                            "focusout",
                            "animationend",
                            "transitionend",
                        ]),
                        s = e.modules,
                        l = void 0 === s ? new Map(Yt.modules) : s,
                        c = e.stack,
                        u = void 0 === c ? Yt.stack : c,
                        f = { elem: null, container: null, content: null, iconContainer: null, titleContainer: null, textContainer: null },
                        h = a({}, Yt);
                    zt("init", { notice: i, defaults: h });
                    var d,
                        m = e.type,
                        g = void 0 === m ? h.type : m,
                        y = e.title,
                        _ = void 0 === y ? h.title : y,
                        b = e.titleTrusted,
                        w = void 0 === b ? h.titleTrusted : b,
                        C = e.text,
                        k = void 0 === C ? h.text : C,
                        x = e.textTrusted,
                        $ = void 0 === x ? h.textTrusted : x,
                        E = e.styling,
                        O = void 0 === E ? h.styling : E,
                        S = e.icons,
                        L = void 0 === S ? h.icons : S,
                        T = e.mode,
                        P = void 0 === T ? h.mode : T,
                        A = e.addClass,
                        H = void 0 === A ? h.addClass : A,
                        N = e.addModalClass,
                        R = void 0 === N ? h.addModalClass : N,
                        D = e.addModelessClass,
                        W = void 0 === D ? h.addModelessClass : D,
                        I = e.autoOpen,
                        X = void 0 === I ? h.autoOpen : I,
                        F = e.width,
                        B = void 0 === F ? h.width : F,
                        V = e.minHeight,
                        z = void 0 === V ? h.minHeight : V,
                        q = e.maxTextHeight,
                        G = void 0 === q ? h.maxTextHeight : q,
                        Z = e.icon,
                        K = void 0 === Z ? h.icon : Z,
                        J = e.animation,
                        Q = void 0 === J ? h.animation : J,
                        tt = e.animateSpeed,
                        et = void 0 === tt ? h.animateSpeed : tt,
                        nt = e.shadow,
                        it = void 0 === nt ? h.shadow : nt,
                        ot = e.hide,
                        rt = void 0 === ot ? h.hide : ot,
                        st = e.delay,
                        lt = void 0 === st ? h.delay : st,
                        at = e.mouseReset,
                        ct = void 0 === at ? h.mouseReset : at,
                        ut = e.closer,
                        ft = void 0 === ut ? h.closer : ut,
                        ht = e.closerHover,
                        dt = void 0 === ht ? h.closerHover : ht,
                        pt = e.sticker,
                        vt = void 0 === pt ? h.sticker : pt,
                        mt = e.stickerHover,
                        gt = void 0 === mt ? h.stickerHover : mt,
                        yt = e.labels,
                        _t = void 0 === yt ? h.labels : yt,
                        bt = e.remove,
                        wt = void 0 === bt ? h.remove : bt,
                        Ct = e.destroy,
                        kt = void 0 === Ct ? h.destroy : Ct,
                        xt = "closed",
                        $t = null,
                        Et = null,
                        Ot = null,
                        St = !1,
                        Lt = "",
                        Tt = "",
                        Pt = !1,
                        Mt = !1,
                        At = { elem: [], container: [] },
                        Ht = !1,
                        Nt = !1,
                        Rt = !1,
                        Dt = !1,
                        jt = null,
                        Wt = rt,
                        It = null,
                        Xt = null,
                        Ft = u && (!0 === u.modal || ("ish" === u.modal && "prevented" === $t)),
                        Bt = NaN,
                        Vt = null,
                        Ut = null;
                    function zt(t) {
                        var e = a({ notice: i }, arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : {});
                        "init" === t &&
                            Array.from(l).forEach(function (t) {
                                var n = p(t, 2),
                                    i = n[0];
                                return n[1], "init" in i && i.init(e);
                            });
                        var n = f.elem || (u && u.context) || document.body;
                        if (!n) return o("pnotify:".concat(t), e), !0;
                        var r = new Event("pnotify:".concat(t), { bubbles: "init" === t || "mount" === t, cancelable: t.startsWith("before") });
                        return (r.detail = e), n.dispatchEvent(r), !r.defaultPrevented;
                    }
                    function qt() {
                        var t = (u && u.context) || document.body;
                        if (!t) throw new Error("No context to insert this notice into.");
                        if (!f.elem) throw new Error("Trying to insert notice before element is available.");
                        f.elem.parentNode !== t && t.appendChild(f.elem);
                    }
                    function Gt() {
                        f.elem && f.elem.parentNode.removeChild(f.elem);
                    }
                    (d = function () {
                        zt("mount"), X && ae().catch(function () { });
                    }),
                        j().$$.on_mount.push(d),
                        j().$$.before_update.push(function () {
                            zt("update"), "closed" !== xt && "waiting" !== xt && rt !== Wt && (rt ? Wt || me() : ve()), "closed" !== xt && "closing" !== xt && u && !u._collapsingModalState && u.queuePosition(), (Wt = rt);
                        });
                    var Zt,
                        Kt,
                        Jt,
                        Qt,
                        te,
                        ee,
                        ne,
                        ie,
                        oe,
                        re,
                        se,
                        le = e.open,
                        ae =
                            void 0 === le
                                ? function (t) {
                                    if ("opening" === xt) return It;
                                    if ("open" === xt) return rt && me(), Promise.resolve();
                                    if (!Ht && u && u._shouldNoticeWait(i)) return (xt = "waiting"), Promise.reject();
                                    if (!zt("beforeOpen", { immediate: t })) return Promise.reject();
                                    var e, o;
                                    (xt = "opening"), n(28, (Rt = !1)), n(24, (Lt = "pnotify-initial pnotify-hidden"));
                                    var r = new Promise(function (t, n) {
                                        (e = t), (o = n);
                                    });
                                    It = r;
                                    var s = function () {
                                        rt && me(), (xt = "open"), zt("afterOpen", { immediate: t }), (It = null), e();
                                    };
                                    return Nt
                                        ? (s(), Promise.resolve())
                                        : (qt(),
                                            window.requestAnimationFrame(function () {
                                                if ("opening" !== xt) return o(), void (It = null);
                                                u && (n(0, (u._animation = !1), u), "top" === u.push && u._resetPositionData(), u._positionNotice(i), u.queuePosition(0), n(0, (u._animation = !0), u)), he(s, t);
                                            }),
                                            r);
                                }
                                : le,
                        ce = e.close,
                        ue =
                            void 0 === ce
                                ? function (t, e, o) {
                                    if ("closing" === xt) return Xt;
                                    if ("closed" === xt) return Promise.resolve();
                                    var r,
                                        s = function () {
                                            zt("beforeDestroy") && (u && u._removeNotice(i), i.$destroy(), zt("afterDestroy"));
                                        };
                                    if ("waiting" === xt) return o || ((xt = "closed"), kt && !o && s()), Promise.resolve();
                                    if (!zt("beforeClose", { immediate: t, timerHide: e, waitAfterward: o })) return Promise.reject();
                                    (xt = "closing"), (Pt = !!e), $t && "prevented" !== $t && clearTimeout && clearTimeout($t), ($t = null);
                                    var l = new Promise(function (t, e) {
                                        r = t;
                                    });
                                    return (
                                        (Xt = l),
                                        pe(function () {
                                            n(26, (Mt = !1)), (Pt = !1), (xt = o ? "waiting" : "closed"), zt("afterClose", { immediate: t, timerHide: e, waitAfterward: o }), (Xt = null), r(), o || (kt ? s() : wt && Gt());
                                        }, t),
                                        l
                                    );
                                }
                                : ce,
                        fe = e.animateIn,
                        he =
                            void 0 === fe
                                ? function (t, e) {
                                    St = "in";
                                    var i = function e(n) {
                                        if (!((n && f.elem && n.target !== f.elem) || (f.elem && f.elem.removeEventListener("transitionend", e), Et && clearTimeout(Et), "in" !== St))) {
                                            var i = Nt;
                                            if (!i && f.elem) {
                                                var o = f.elem.getBoundingClientRect();
                                                for (var r in o)
                                                    if (o[r] > 0) {
                                                        i = !0;
                                                        break;
                                                    }
                                            }
                                            i ? (t && t.call(), (St = !1)) : (Et = setTimeout(e, 40));
                                        }
                                    };
                                    if ("fade" !== Q || e) {
                                        var o = Q;
                                        n(2, (Q = "none")),
                                            n(24, (Lt = "pnotify-in ".concat("fade" === o ? "pnotify-fade-in" : ""))),
                                            U().then(function () {
                                                n(2, (Q = o)), i();
                                            });
                                    } else
                                        f.elem && f.elem.addEventListener("transitionend", i),
                                            n(24, (Lt = "pnotify-in")),
                                            U().then(function () {
                                                n(24, (Lt = "pnotify-in pnotify-fade-in")), (Et = setTimeout(i, 650));
                                            });
                                }
                                : fe,
                        de = e.animateOut,
                        pe =
                            void 0 === de
                                ? function (t, e) {
                                    St = "out";
                                    var i = function e(i) {
                                        if (!((i && f.elem && i.target !== f.elem) || (f.elem && f.elem.removeEventListener("transitionend", e), Ot && clearTimeout(Ot), "out" !== St))) {
                                            var o = Nt;
                                            if (!o && f.elem) {
                                                var r = f.elem.getBoundingClientRect();
                                                for (var s in r)
                                                    if (r[s] > 0) {
                                                        o = !0;
                                                        break;
                                                    }
                                            }
                                            f.elem && f.elem.style.opacity && "0" !== f.elem.style.opacity && o ? (Ot = setTimeout(e, 40)) : (n(24, (Lt = "")), t && t.call(), (St = !1));
                                        }
                                    };
                                    "fade" !== Q || e
                                        ? (n(24, (Lt = "")),
                                            U().then(function () {
                                                i();
                                            }))
                                        : (f.elem && f.elem.addEventListener("transitionend", i), n(24, (Lt = "pnotify-in")), (Ot = setTimeout(i, 650)));
                                }
                                : de;
                    function ve() {
                        $t && "prevented" !== $t && (clearTimeout($t), ($t = null)), Ot && clearTimeout(Ot), "closing" === xt && ((xt = "open"), (St = !1), n(24, (Lt = "fade" === Q ? "pnotify-in pnotify-fade-in" : "pnotify-in")));
                    }
                    function me() {
                        "prevented" !== $t &&
                            (ve(),
                                lt !== 1 / 0 &&
                                ($t = setTimeout(
                                    function () {
                                        return ue(!1, !0);
                                    },
                                    isNaN(lt) ? 0 : lt
                                )));
                    }
                    return (
                        (t.$$set = function (t) {
                            "modules" in t && n(46, (l = t.modules)),
                                "stack" in t && n(0, (u = t.stack)),
                                "type" in t && n(4, (g = t.type)),
                                "title" in t && n(5, (_ = t.title)),
                                "titleTrusted" in t && n(6, (w = t.titleTrusted)),
                                "text" in t && n(7, (k = t.text)),
                                "textTrusted" in t && n(8, ($ = t.textTrusted)),
                                "styling" in t && n(47, (O = t.styling)),
                                "icons" in t && n(48, (L = t.icons)),
                                "mode" in t && n(9, (P = t.mode)),
                                "addClass" in t && n(10, (H = t.addClass)),
                                "addModalClass" in t && n(11, (R = t.addModalClass)),
                                "addModelessClass" in t && n(12, (W = t.addModelessClass)),
                                "autoOpen" in t && n(49, (X = t.autoOpen)),
                                "width" in t && n(50, (B = t.width)),
                                "minHeight" in t && n(51, (z = t.minHeight)),
                                "maxTextHeight" in t && n(52, (G = t.maxTextHeight)),
                                "icon" in t && n(13, (K = t.icon)),
                                "animation" in t && n(2, (Q = t.animation)),
                                "animateSpeed" in t && n(14, (et = t.animateSpeed)),
                                "shadow" in t && n(15, (it = t.shadow)),
                                "hide" in t && n(3, (rt = t.hide)),
                                "delay" in t && n(53, (lt = t.delay)),
                                "mouseReset" in t && n(54, (ct = t.mouseReset)),
                                "closer" in t && n(16, (ft = t.closer)),
                                "closerHover" in t && n(17, (dt = t.closerHover)),
                                "sticker" in t && n(18, (vt = t.sticker)),
                                "stickerHover" in t && n(19, (gt = t.stickerHover)),
                                "labels" in t && n(20, (_t = t.labels)),
                                "remove" in t && n(55, (wt = t.remove)),
                                "destroy" in t && n(56, (kt = t.destroy)),
                                "open" in t && n(59, (ae = t.open)),
                                "close" in t && n(23, (ue = t.close)),
                                "animateIn" in t && n(60, (he = t.animateIn)),
                                "animateOut" in t && n(61, (pe = t.animateOut));
                        }),
                        (t.$$.update = function () {
                            524288 & t.$$.dirty[1] && n(31, (Zt = "string" == typeof B ? "width: ".concat(B, ";") : "")),
                                1048576 & t.$$.dirty[1] && n(32, (Kt = "string" == typeof z ? "min-height: ".concat(z, ";") : "")),
                                2097152 & t.$$.dirty[1] && n(33, (Jt = "string" == typeof G ? "max-height: ".concat(G, ";") : "")),
                                32 & t.$$.dirty[0] && n(34, (Qt = _ instanceof HTMLElement)),
                                128 & t.$$.dirty[0] && n(35, (te = k instanceof HTMLElement)),
                                (1 & t.$$.dirty[0]) | (1792 & t.$$.dirty[3]) &&
                                Bt !== u &&
                                (Bt && (Bt._removeNotice(i), n(30, (Ft = !1)), Vt(), Ut()),
                                    u &&
                                    (u._addNotice(i),
                                        n(
                                            102,
                                            (Vt = u.on("beforeAddOverlay", function () {
                                                n(30, (Ft = !0)), zt("enterModal");
                                            }))
                                        ),
                                        n(
                                            103,
                                            (Ut = u.on("afterRemoveOverlay", function () {
                                                n(30, (Ft = !1)), zt("leaveModal");
                                            }))
                                        )),
                                    n(101, (Bt = u))),
                                1073748992 & t.$$.dirty[0] && n(36, (ee = H.match(/\bnonblock\b/) || (R.match(/\bnonblock\b/) && Ft) || (W.match(/\bnonblock\b/) && !Ft))),
                                1 & t.$$.dirty[0] && n(37, (ne = u && u.dir1 ? "pnotify-stack-".concat(u.dir1) : "")),
                                32768 & t.$$.dirty[1] &&
                                n(
                                    38,
                                    (ie = Array.from(l).filter(function (t) {
                                        var e = p(t, 2),
                                            n = e[0];
                                        return e[1], "PrependContainer" === n.position;
                                    }))
                                ),
                                32768 & t.$$.dirty[1] &&
                                n(
                                    39,
                                    (oe = Array.from(l).filter(function (t) {
                                        var e = p(t, 2),
                                            n = e[0];
                                        return e[1], "PrependContent" === n.position;
                                    }))
                                ),
                                32768 & t.$$.dirty[1] &&
                                n(
                                    40,
                                    (re = Array.from(l).filter(function (t) {
                                        var e = p(t, 2),
                                            n = e[0];
                                        return e[1], "AppendContent" === n.position;
                                    }))
                                ),
                                32768 & t.$$.dirty[1] &&
                                n(
                                    41,
                                    (se = Array.from(l).filter(function (t) {
                                        var e = p(t, 2),
                                            n = e[0];
                                        return e[1], "AppendContainer" === n.position;
                                    }))
                                ),
                                (34 & t.$$.dirty[0]) | (8 & t.$$.dirty[1]) && Qt && f.titleContainer && f.titleContainer.appendChild(_),
                                (130 & t.$$.dirty[0]) | (16 & t.$$.dirty[1]) && te && f.textContainer && f.textContainer.appendChild(k);
                        }),
                        [
                            u,
                            f,
                            Q,
                            rt,
                            g,
                            _,
                            w,
                            k,
                            $,
                            P,
                            H,
                            R,
                            W,
                            K,
                            et,
                            it,
                            ft,
                            dt,
                            vt,
                            gt,
                            _t,
                            function (t) {
                                return "string" == typeof O ? "".concat(O, "-").concat(t) : t in O ? O[t] : "".concat(O.prefix, "-").concat(t);
                            },
                            function (t) {
                                return "string" == typeof L ? "".concat(L, "-icon-").concat(t) : t in L ? L[t] : "".concat(L.prefix, "-icon-").concat(t);
                            },
                            ue,
                            Lt,
                            Tt,
                            Mt,
                            At,
                            Rt,
                            Dt,
                            Ft,
                            Zt,
                            Kt,
                            Jt,
                            Qt,
                            te,
                            ee,
                            ne,
                            ie,
                            oe,
                            re,
                            se,
                            i,
                            r,
                            function (t) {
                                if ((n(26, (Mt = !0)), ct && "closing" === xt)) {
                                    if (!Pt) return;
                                    ve();
                                }
                                rt && ct && ve();
                            },
                            function (t) {
                                n(26, (Mt = !1)), rt && ct && "out" !== St && -1 !== ["open", "opening"].indexOf(xt) && me();
                            },
                            l,
                            O,
                            L,
                            X,
                            B,
                            z,
                            G,
                            lt,
                            ct,
                            wt,
                            kt,
                            function () {
                                return xt;
                            },
                            function () {
                                return $t;
                            },
                            ae,
                            he,
                            pe,
                            ve,
                            me,
                            function (t) {
                                t ? (ve(), ($t = "prevented")) : "prevented" === $t && (($t = null), "open" === xt && rt && me());
                            },
                            function () {
                                return i.$on.apply(i, arguments);
                            },
                            function () {
                                return i.$set.apply(i, arguments);
                            },
                            function (t, e) {
                                o(t, e);
                            },
                            function (t) {
                                for (var e = 0; e < (arguments.length <= 1 ? 0 : arguments.length - 1); e++) {
                                    var i = e + 1 < 1 || arguments.length <= e + 1 ? void 0 : arguments[e + 1];
                                    -1 === At[t].indexOf(i) && At[t].push(i);
                                }
                                n(27, At);
                            },
                            function (t) {
                                for (var e = 0; e < (arguments.length <= 1 ? 0 : arguments.length - 1); e++) {
                                    var i = e + 1 < 1 || arguments.length <= e + 1 ? void 0 : arguments[e + 1],
                                        o = At[t].indexOf(i);
                                    -1 !== o && At[t].splice(o, 1);
                                }
                                n(27, At);
                            },
                            function (t) {
                                for (var e = 0; e < (arguments.length <= 1 ? 0 : arguments.length - 1); e++) {
                                    var n = e + 1 < 1 || arguments.length <= e + 1 ? void 0 : arguments[e + 1];
                                    if (-1 === At[t].indexOf(n)) return !1;
                                }
                                return !0;
                            },
                            function () {
                                return Ht;
                            },
                            function (t) {
                                return (Ht = t);
                            },
                            function () {
                                return Nt;
                            },
                            function (t) {
                                return (Nt = t);
                            },
                            function (t) {
                                return (St = t);
                            },
                            function () {
                                return Lt;
                            },
                            function (t) {
                                return n(24, (Lt = t));
                            },
                            function () {
                                return Tt;
                            },
                            function (t) {
                                return n(25, (Tt = t));
                            },
                            function (t, e, i) {
                                if ((jt && clearTimeout(jt), Rt !== t))
                                    if (t)
                                        n(28, (Rt = !0)),
                                            n(29, (Dt = !!e)),
                                            qt(),
                                            U().then(function () {
                                                window.requestAnimationFrame(function () {
                                                    if (Rt)
                                                        if (e && i) i();
                                                        else {
                                                            n(29, (Dt = !0));
                                                            var t = function t() {
                                                                f.elem && f.elem.removeEventListener("transitionend", t), jt && clearTimeout(jt), Dt && i && i();
                                                            };
                                                            f.elem && f.elem.addEventListener("transitionend", t), (jt = setTimeout(t, 650));
                                                        }
                                                });
                                            });
                                    else if (e) n(28, (Rt = !1)), n(29, (Dt = !1)), wt && -1 === ["open", "opening", "closing"].indexOf(xt) && Gt(), i && i();
                                    else {
                                        var o = function t() {
                                            f.elem && f.elem.removeEventListener("transitionend", t), jt && clearTimeout(jt), Dt || (n(28, (Rt = !1)), wt && -1 === ["open", "opening", "closing"].indexOf(xt) && Gt(), i && i());
                                        };
                                        n(29, (Dt = !1)), f.elem && f.elem.addEventListener("transitionend", o), f.elem && f.elem.style.opacity, (jt = setTimeout(o, 650));
                                    }
                            },
                            function () {
                                return ue(!1);
                            },
                            function () {
                                return n(3, (rt = !rt));
                            },
                            function (t) {
                                Y[t ? "unshift" : "push"](function () {
                                    (f.iconContainer = t), n(1, f);
                                });
                            },
                            function (t) {
                                Y[t ? "unshift" : "push"](function () {
                                    (f.titleContainer = t), n(1, f);
                                });
                            },
                            function (t) {
                                Y[t ? "unshift" : "push"](function () {
                                    (f.textContainer = t), n(1, f);
                                });
                            },
                            function (t) {
                                Y[t ? "unshift" : "push"](function () {
                                    (f.content = t), n(1, f);
                                });
                            },
                            function (t) {
                                Y[t ? "unshift" : "push"](function () {
                                    (f.container = t), n(1, f);
                                });
                            },
                            function (t) {
                                Y[t ? "unshift" : "push"](function () {
                                    (f.elem = t), n(1, f);
                                });
                            },
                        ]
                    );
                }
                window && document.body ? It() : document.addEventListener("DOMContentLoaded", It);
                var Ft = (function (t) {
                    !(function (t, e) {
                        if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function");
                        (t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } })), e && u(t, e);
                    })(s, t);
                    var e,
                        n,
                        o =
                            ((e = s),
                                (n = f()),
                                function () {
                                    var t,
                                        i = c(e);
                                    if (n) {
                                        var o = c(this).constructor;
                                        t = Reflect.construct(i, arguments, o);
                                    } else t = i.apply(this, arguments);
                                    return (function (t, e) {
                                        return !e || ("object" != typeof e && "function" != typeof e) ? d(t) : e;
                                    })(this, t);
                                });
                    function s(t) {
                        var e;
                        return (
                            i(this, s),
                            (function (t, e, n, i, o, r) {
                                var s = arguments.length > 6 && void 0 !== arguments[6] ? arguments[6] : [-1],
                                    l = N;
                                D(t);
                                var a = e.props || {},
                                    c = (t.$$ = {
                                        fragment: null,
                                        ctx: null,
                                        props: r,
                                        update: y,
                                        not_equal: o,
                                        bound: w(),
                                        on_mount: [],
                                        on_destroy: [],
                                        before_update: [],
                                        after_update: [],
                                        context: new Map(l ? l.$$.context : []),
                                        callbacks: w(),
                                        dirty: s,
                                        skip_bound: !1,
                                    }),
                                    u = !1;
                                if (
                                    ((c.ctx = n
                                        ? n(t, a, function (e, n) {
                                            var i = !(arguments.length <= 2) && arguments.length - 2 ? (arguments.length <= 2 ? void 0 : arguments[2]) : n;
                                            return (
                                                c.ctx &&
                                                o(c.ctx[e], (c.ctx[e] = i)) &&
                                                (!c.skip_bound && c.bound[e] && c.bound[e](i),
                                                    u &&
                                                    (function (t, e) {
                                                        -1 === t.$$.dirty[0] && (W.push(t), V(), t.$$.dirty.fill(0)), (t.$$.dirty[(e / 31) | 0] |= 1 << e % 31);
                                                    })(t, e)),
                                                n
                                            );
                                        })
                                        : []),
                                        c.update(),
                                        (u = !0),
                                        C(c.before_update),
                                        (c.fragment = !!i && i(c.ctx)),
                                        e.target)
                                ) {
                                    if (e.hydrate) {
                                        var f = (function (t) {
                                            return Array.from(t.childNodes);
                                        })(e.target);
                                        c.fragment && c.fragment.l(f), f.forEach(O);
                                    } else c.fragment && c.fragment.c();
                                    e.intro && nt(t.$$.fragment), ut(t, e.target, e.anchor), Z();
                                }
                                D(l);
                            })(
                                d((e = o.call(this))),
                                t,
                                Xt,
                                Nt,
                                x,
                                {
                                    modules: 46,
                                    stack: 0,
                                    refs: 1,
                                    type: 4,
                                    title: 5,
                                    titleTrusted: 6,
                                    text: 7,
                                    textTrusted: 8,
                                    styling: 47,
                                    icons: 48,
                                    mode: 9,
                                    addClass: 10,
                                    addModalClass: 11,
                                    addModelessClass: 12,
                                    autoOpen: 49,
                                    width: 50,
                                    minHeight: 51,
                                    maxTextHeight: 52,
                                    icon: 13,
                                    animation: 2,
                                    animateSpeed: 14,
                                    shadow: 15,
                                    hide: 3,
                                    delay: 53,
                                    mouseReset: 54,
                                    closer: 16,
                                    closerHover: 17,
                                    sticker: 18,
                                    stickerHover: 19,
                                    labels: 20,
                                    remove: 55,
                                    destroy: 56,
                                    getState: 57,
                                    getTimer: 58,
                                    getStyle: 21,
                                    getIcon: 22,
                                    open: 59,
                                    close: 23,
                                    animateIn: 60,
                                    animateOut: 61,
                                    cancelClose: 62,
                                    queueClose: 63,
                                    _preventTimerClose: 64,
                                    on: 65,
                                    update: 66,
                                    fire: 67,
                                    addModuleClass: 68,
                                    removeModuleClass: 69,
                                    hasModuleClass: 70,
                                    getModuleHandled: 71,
                                    setModuleHandled: 72,
                                    getModuleOpen: 73,
                                    setModuleOpen: 74,
                                    setAnimating: 75,
                                    getAnimatingClass: 76,
                                    setAnimatingClass: 77,
                                    _getMoveClass: 78,
                                    _setMoveClass: 79,
                                    _setMasking: 80,
                                },
                                [-1, -1, -1, -1]
                            ),
                            e
                        );
                    }
                    return (
                        r(s, [
                            {
                                key: "modules",
                                get: function () {
                                    return this.$$.ctx[46];
                                },
                                set: function (t) {
                                    this.$set({ modules: t }), Z();
                                },
                            },
                            {
                                key: "stack",
                                get: function () {
                                    return this.$$.ctx[0];
                                },
                                set: function (t) {
                                    this.$set({ stack: t }), Z();
                                },
                            },
                            {
                                key: "refs",
                                get: function () {
                                    return this.$$.ctx[1];
                                },
                            },
                            {
                                key: "type",
                                get: function () {
                                    return this.$$.ctx[4];
                                },
                                set: function (t) {
                                    this.$set({ type: t }), Z();
                                },
                            },
                            {
                                key: "title",
                                get: function () {
                                    return this.$$.ctx[5];
                                },
                                set: function (t) {
                                    this.$set({ title: t }), Z();
                                },
                            },
                            {
                                key: "titleTrusted",
                                get: function () {
                                    return this.$$.ctx[6];
                                },
                                set: function (t) {
                                    this.$set({ titleTrusted: t }), Z();
                                },
                            },
                            {
                                key: "text",
                                get: function () {
                                    return this.$$.ctx[7];
                                },
                                set: function (t) {
                                    this.$set({ text: t }), Z();
                                },
                            },
                            {
                                key: "textTrusted",
                                get: function () {
                                    return this.$$.ctx[8];
                                },
                                set: function (t) {
                                    this.$set({ textTrusted: t }), Z();
                                },
                            },
                            {
                                key: "styling",
                                get: function () {
                                    return this.$$.ctx[47];
                                },
                                set: function (t) {
                                    this.$set({ styling: t }), Z();
                                },
                            },
                            {
                                key: "icons",
                                get: function () {
                                    return this.$$.ctx[48];
                                },
                                set: function (t) {
                                    this.$set({ icons: t }), Z();
                                },
                            },
                            {
                                key: "mode",
                                get: function () {
                                    return this.$$.ctx[9];
                                },
                                set: function (t) {
                                    this.$set({ mode: t }), Z();
                                },
                            },
                            {
                                key: "addClass",
                                get: function () {
                                    return this.$$.ctx[10];
                                },
                                set: function (t) {
                                    this.$set({ addClass: t }), Z();
                                },
                            },
                            {
                                key: "addModalClass",
                                get: function () {
                                    return this.$$.ctx[11];
                                },
                                set: function (t) {
                                    this.$set({ addModalClass: t }), Z();
                                },
                            },
                            {
                                key: "addModelessClass",
                                get: function () {
                                    return this.$$.ctx[12];
                                },
                                set: function (t) {
                                    this.$set({ addModelessClass: t }), Z();
                                },
                            },
                            {
                                key: "autoOpen",
                                get: function () {
                                    return this.$$.ctx[49];
                                },
                                set: function (t) {
                                    this.$set({ autoOpen: t }), Z();
                                },
                            },
                            {
                                key: "width",
                                get: function () {
                                    return this.$$.ctx[50];
                                },
                                set: function (t) {
                                    this.$set({ width: t }), Z();
                                },
                            },
                            {
                                key: "minHeight",
                                get: function () {
                                    return this.$$.ctx[51];
                                },
                                set: function (t) {
                                    this.$set({ minHeight: t }), Z();
                                },
                            },
                            {
                                key: "maxTextHeight",
                                get: function () {
                                    return this.$$.ctx[52];
                                },
                                set: function (t) {
                                    this.$set({ maxTextHeight: t }), Z();
                                },
                            },
                            {
                                key: "icon",
                                get: function () {
                                    return this.$$.ctx[13];
                                },
                                set: function (t) {
                                    this.$set({ icon: t }), Z();
                                },
                            },
                            {
                                key: "animation",
                                get: function () {
                                    return this.$$.ctx[2];
                                },
                                set: function (t) {
                                    this.$set({ animation: t }), Z();
                                },
                            },
                            {
                                key: "animateSpeed",
                                get: function () {
                                    return this.$$.ctx[14];
                                },
                                set: function (t) {
                                    this.$set({ animateSpeed: t }), Z();
                                },
                            },
                            {
                                key: "shadow",
                                get: function () {
                                    return this.$$.ctx[15];
                                },
                                set: function (t) {
                                    this.$set({ shadow: t }), Z();
                                },
                            },
                            {
                                key: "hide",
                                get: function () {
                                    return this.$$.ctx[3];
                                },
                                set: function (t) {
                                    this.$set({ hide: t }), Z();
                                },
                            },
                            {
                                key: "delay",
                                get: function () {
                                    return this.$$.ctx[53];
                                },
                                set: function (t) {
                                    this.$set({ delay: t }), Z();
                                },
                            },
                            {
                                key: "mouseReset",
                                get: function () {
                                    return this.$$.ctx[54];
                                },
                                set: function (t) {
                                    this.$set({ mouseReset: t }), Z();
                                },
                            },
                            {
                                key: "closer",
                                get: function () {
                                    return this.$$.ctx[16];
                                },
                                set: function (t) {
                                    this.$set({ closer: t }), Z();
                                },
                            },
                            {
                                key: "closerHover",
                                get: function () {
                                    return this.$$.ctx[17];
                                },
                                set: function (t) {
                                    this.$set({ closerHover: t }), Z();
                                },
                            },
                            {
                                key: "sticker",
                                get: function () {
                                    return this.$$.ctx[18];
                                },
                                set: function (t) {
                                    this.$set({ sticker: t }), Z();
                                },
                            },
                            {
                                key: "stickerHover",
                                get: function () {
                                    return this.$$.ctx[19];
                                },
                                set: function (t) {
                                    this.$set({ stickerHover: t }), Z();
                                },
                            },
                            {
                                key: "labels",
                                get: function () {
                                    return this.$$.ctx[20];
                                },
                                set: function (t) {
                                    this.$set({ labels: t }), Z();
                                },
                            },
                            {
                                key: "remove",
                                get: function () {
                                    return this.$$.ctx[55];
                                },
                                set: function (t) {
                                    this.$set({ remove: t }), Z();
                                },
                            },
                            {
                                key: "destroy",
                                get: function () {
                                    return this.$$.ctx[56];
                                },
                                set: function (t) {
                                    this.$set({ destroy: t }), Z();
                                },
                            },
                            {
                                key: "getState",
                                get: function () {
                                    return this.$$.ctx[57];
                                },
                            },
                            {
                                key: "getTimer",
                                get: function () {
                                    return this.$$.ctx[58];
                                },
                            },
                            {
                                key: "getStyle",
                                get: function () {
                                    return this.$$.ctx[21];
                                },
                            },
                            {
                                key: "getIcon",
                                get: function () {
                                    return this.$$.ctx[22];
                                },
                            },
                            {
                                key: "open",
                                get: function () {
                                    return this.$$.ctx[59];
                                },
                                set: function (t) {
                                    this.$set({ open: t }), Z();
                                },
                            },
                            {
                                key: "close",
                                get: function () {
                                    return this.$$.ctx[23];
                                },
                                set: function (t) {
                                    this.$set({ close: t }), Z();
                                },
                            },
                            {
                                key: "animateIn",
                                get: function () {
                                    return this.$$.ctx[60];
                                },
                                set: function (t) {
                                    this.$set({ animateIn: t }), Z();
                                },
                            },
                            {
                                key: "animateOut",
                                get: function () {
                                    return this.$$.ctx[61];
                                },
                                set: function (t) {
                                    this.$set({ animateOut: t }), Z();
                                },
                            },
                            {
                                key: "cancelClose",
                                get: function () {
                                    return this.$$.ctx[62];
                                },
                            },
                            {
                                key: "queueClose",
                                get: function () {
                                    return this.$$.ctx[63];
                                },
                            },
                            {
                                key: "_preventTimerClose",
                                get: function () {
                                    return this.$$.ctx[64];
                                },
                            },
                            {
                                key: "on",
                                get: function () {
                                    return this.$$.ctx[65];
                                },
                            },
                            {
                                key: "update",
                                get: function () {
                                    return this.$$.ctx[66];
                                },
                            },
                            {
                                key: "fire",
                                get: function () {
                                    return this.$$.ctx[67];
                                },
                            },
                            {
                                key: "addModuleClass",
                                get: function () {
                                    return this.$$.ctx[68];
                                },
                            },
                            {
                                key: "removeModuleClass",
                                get: function () {
                                    return this.$$.ctx[69];
                                },
                            },
                            {
                                key: "hasModuleClass",
                                get: function () {
                                    return this.$$.ctx[70];
                                },
                            },
                            {
                                key: "getModuleHandled",
                                get: function () {
                                    return this.$$.ctx[71];
                                },
                            },
                            {
                                key: "setModuleHandled",
                                get: function () {
                                    return this.$$.ctx[72];
                                },
                            },
                            {
                                key: "getModuleOpen",
                                get: function () {
                                    return this.$$.ctx[73];
                                },
                            },
                            {
                                key: "setModuleOpen",
                                get: function () {
                                    return this.$$.ctx[74];
                                },
                            },
                            {
                                key: "setAnimating",
                                get: function () {
                                    return this.$$.ctx[75];
                                },
                            },
                            {
                                key: "getAnimatingClass",
                                get: function () {
                                    return this.$$.ctx[76];
                                },
                            },
                            {
                                key: "setAnimatingClass",
                                get: function () {
                                    return this.$$.ctx[77];
                                },
                            },
                            {
                                key: "_getMoveClass",
                                get: function () {
                                    return this.$$.ctx[78];
                                },
                            },
                            {
                                key: "_setMoveClass",
                                get: function () {
                                    return this.$$.ctx[79];
                                },
                            },
                            {
                                key: "_setMasking",
                                get: function () {
                                    return this.$$.ctx[80];
                                },
                            },
                        ]),
                        s
                    );
                })(ht);
                (t.Stack = dt),
                    (t.alert = function (t) {
                        return pt(Rt(t));
                    }),
                    (t.default = Ft),
                    (t.defaultModules = Wt),
                    (t.defaultStack = jt),
                    (t.defaults = Yt),
                    (t.error = function (t) {
                        return pt(Rt(t, "error"));
                    }),
                    (t.info = function (t) {
                        return pt(Rt(t, "info"));
                    }),
                    (t.notice = function (t) {
                        return pt(Rt(t, "notice"));
                    }),
                    (t.success = function (t) {
                        return pt(Rt(t, "success"));
                    }),
                    Object.defineProperty(t, "__esModule", { value: !0 });
            })(e);
        },
        311: (t) => {
            "use strict";
            t.exports = jQuery;
        },
    },
        e = {};
    function n(i) {
        var o = e[i];
        if (void 0 !== o) return o.exports;
        var r = (e[i] = { exports: {} });
        return t[i].call(r.exports, r, r.exports, n), r.exports;
    }
    (n.g = (function () {
        if ("object" == typeof globalThis) return globalThis;
        try {
            return this || new Function("return this")();
        } catch (t) {
            if ("object" == typeof window) return window;
        }
    })()),
        (n.p = "/"),
        (() => {
            "use strict";
            function t(t) {
                for (var e = 1; e < arguments.length; e++) {
                    var n = arguments[e];
                    for (var i in n) t[i] = n[i];
                }
                return t;
            }
            var e = (function e(n, i) {
                function o(e, o, r) {
                    if ("undefined" != typeof document) {
                        "number" == typeof (r = t({}, i, r)).expires && (r.expires = new Date(Date.now() + 864e5 * r.expires)),
                            r.expires && (r.expires = r.expires.toUTCString()),
                            (e = encodeURIComponent(e)
                                .replace(/%(2[346B]|5E|60|7C)/g, decodeURIComponent)
                                .replace(/[()]/g, escape));
                        var s = "";
                        for (var l in r) r[l] && ((s += "; " + l), !0 !== r[l] && (s += "=" + r[l].split(";")[0]));
                        return (document.cookie = e + "=" + n.write(o, e) + s);
                    }
                }
                return Object.create(
                    {
                        set: o,
                        get: function (t) {
                            if ("undefined" != typeof document && (!arguments.length || t)) {
                                for (var e = document.cookie ? document.cookie.split("; ") : [], i = {}, o = 0; o < e.length; o++) {
                                    var r = e[o].split("="),
                                        s = r.slice(1).join("=");
                                    try {
                                        var l = decodeURIComponent(r[0]);
                                        if (((i[l] = n.read(s, l)), t === l)) break;
                                    } catch (t) { }
                                }
                                return t ? i[t] : i;
                            }
                        },
                        remove: function (e, n) {
                            o(e, "", t({}, n, { expires: -1 }));
                        },
                        withAttributes: function (n) {
                            return e(this.converter, t({}, this.attributes, n));
                        },
                        withConverter: function (n) {
                            return e(t({}, this.converter, n), this.attributes);
                        },
                    },
                    { attributes: { value: Object.freeze(i) }, converter: { value: Object.freeze(n) } }
                );
            })(
                {
                    read: function (t) {
                        return '"' === t[0] && (t = t.slice(1, -1)), t.replace(/(%[\dA-F]{2})+/gi, decodeURIComponent);
                    },
                    write: function (t) {
                        return encodeURIComponent(t).replace(/%(2[346BF]|3[AC-F]|40|5[BDE]|60|7[BCD])/g, decodeURIComponent);
                    },
                },
                { path: "/" }
            );
            n(265),
                (function (t) {
                    t(document).ready(function () {
                        t(document).on("click", ".vote-block li", function () {
                            var e = t(this),
                                n = e.parents(".vote-block").data("id"),
                                i = e.parents(".vote-block").data("total"),
                                o = e.parents(".vote-block").data("rating"),
                                r = parseInt(e.text(), 10);
                            if (e.parents(".vote-block").hasClass("disabled")) return !1;
                            var s = { action: "set_rating_post", nonce: fsPoppif.nonce, id: n, num: r };
                            return (
                                t.post(fsPoppif.url, s, function (t) {
                                    if ("limit" === t) return !1;
                                    e.parent().parent().addClass("disabled");
                                    var s = "vote-post-" + n,
                                        l = new Date(new Date().getTime() + 6048e5);
                                    (document.cookie = s + "=" + !0 + "; path=/; expires=" + l.toUTCString()),
                                        e
                                            .parent()
                                            .find(".current span")
                                            .css("width", t + "%"),
                                        i++;
                                    var a = (o + r) / i;
                                    (a = (0 ^ a) === a ? a : a.toFixed(1)), e.parents(".vote-block").find(".rating-average").html(a);
                                }),
                                !1
                            );
                        });
                    });
                })(n(311));
            const i = [
                ["requestFullscreen", "exitFullscreen", "fullscreenElement", "fullscreenEnabled", "fullscreenchange", "fullscreenerror"],
                ["webkitRequestFullscreen", "webkitExitFullscreen", "webkitFullscreenElement", "webkitFullscreenEnabled", "webkitfullscreenchange", "webkitfullscreenerror"],
                ["webkitRequestFullScreen", "webkitCancelFullScreen", "webkitCurrentFullScreenElement", "webkitCancelFullScreen", "webkitfullscreenchange", "webkitfullscreenerror"],
                ["mozRequestFullScreen", "mozCancelFullScreen", "mozFullScreenElement", "mozFullScreenEnabled", "mozfullscreenchange", "mozfullscreenerror"],
                ["msRequestFullscreen", "msExitFullscreen", "msFullscreenElement", "msFullscreenEnabled", "MSFullscreenChange", "MSFullscreenError"],
            ],
                o = (() => {
                    if ("undefined" == typeof document) return !1;
                    const t = i[0],
                        e = {};
                    for (const n of i) {
                        const i = n?.[1];
                        if (i in document) {
                            for (const [i, o] of n.entries()) e[t[i]] = o;
                            return e;
                        }
                    }
                    return !1;
                })(),
                r = { change: o.fullscreenchange, error: o.fullscreenerror };
            let s = {
                request: (t = document.documentElement, e) =>
                    new Promise((n, i) => {
                        const r = () => {
                            s.off("change", r), n();
                        };
                        s.on("change", r);
                        const l = t[o.requestFullscreen](e);
                        l instanceof Promise && l.then(r).catch(i);
                    }),
                exit: () =>
                    new Promise((t, e) => {
                        if (!s.isFullscreen) return void t();
                        const n = () => {
                            s.off("change", n), t();
                        };
                        s.on("change", n);
                        const i = document[o.exitFullscreen]();
                        i instanceof Promise && i.then(n).catch(e);
                    }),
                toggle: (t, e) => (s.isFullscreen ? s.exit() : s.request(t, e)),
                onchange(t) {
                    s.on("change", t);
                },
                onerror(t) {
                    s.on("error", t);
                },
                on(t, e) {
                    const n = r[t];
                    n && document.addEventListener(n, e, !1);
                },
                off(t, e) {
                    const n = r[t];
                    n && document.removeEventListener(n, e, !1);
                },
                raw: o,
            };
            Object.defineProperties(s, {
                isFullscreen: { get: () => Boolean(document[o.fullscreenElement]) },
                element: { enumerable: !0, get: () => document[o.fullscreenElement] ?? void 0 },
                isEnabled: { enumerable: !0, get: () => Boolean(document[o.fullscreenEnabled]) },
            }),
                o || (s = { isEnabled: !1 });
            const l = s;
            !(function (t) {
                var e = (function () {
                    for (var t = 0, e = ["exitFullscreen", "webkitExitFullscreen", "webkitCancelFullScreen", "mozCancelFullScreen", "msExitFullscreen"]; t < e.length; t++) if (e[t] in document) return !0;
                    return !1;
                })();
                function n() {
                    // if (t(".flash-container").data("fullwidth")) {
                    //     var e,
                    //         n = t(".flash-container").data("initwidth");
                    //     (e = t(".s-layout__sidebar").innerWidth() + 30),
                    //         t(".flash-container.iframe").each(function () {
                    //             n = t("iframe", this).width();
                    //         });
                    //     var i = n - 40 + e;
                    //     t(".container").css({ width: i + "px", "max-width": i + "px" }), t("body, html").css("min-width", i + "px");
                    // } else
                    //     t(".flash-container.iframe").each(function () {
                    //         var e, n, i, o, r, s, l, a;
                    //         (o = t(".flash-container")),
                    //             (r = t(".flash-container iframe")),
                    //             window.innerWidth,
                    //             (s = window.innerHeight),
                    //             (l = r.attr("width")),
                    //             (a = r.attr("height")),
                    //             r.hide(),
                    //             (n = (e = o.innerWidth()) / (i = parseInt(l) / parseInt(a))),
                    //             console.log(l),
                    //             console.log(a),
                    //             n > s && (e = (n = s) * i),
                    //             n > 730 && !o.hasClass("fullscreen") && (e = (n = 730) * i),
                    //             r.attr("width", e),
                    //             r.attr("height", n),
                    //             r.show();
                    //     });
                }
                document.addEventListener("DOMContentLoaded", function () {
                    var i = document.getElementById("flash-container"),
                        o = document.getElementById("js-player-start");
                    null != i &&
                        (null == o
                            ? n()
                            : o.addEventListener("click", function (t) {
                                t.preventDefault(),
                                    (function (t, e) {
                                        var i = t.dataset.code,
                                            o = document.getElementById("js-overlay");
                                        (e.innerHTML = i), o.classList.add("hidden"), n();
                                    })(o, i);
                            }),
                            e
                                ? (t(".js-fullscreen").on("click", function (t) {
                                    t.preventDefault(), l.isEnabled && l.request(i);
                                }),
                                    t(".js-close-fullscreen").on("click", function (t) {
                                        t.preventDefault(), l.isEnabled && l.exit(i);
                                    }),
                                    l.on("change", function () {
                                        !(function (e) {
                                            l.isFullscreen
                                                ? (t(".js-stop").removeClass("hidden"), t(".js-play").addClass("hidden"), e.classList.add("fullscreen"))
                                                : (t(".js-play").removeClass("hidden"), t(".js-stop").addClass("hidden"), e.classList.remove("fullscreen"));
                                        })(i);
                                    }))
                                : (t(".js-stop").addClass("hidden"), t(".js-play").addClass("hidden")));
                }),
                    t(document).ready(function () { }),
                    t(window).on("load", function () { }),
                    t(window).on("resize", function () {
                        l.isFullscreen || n();
                    });
            })(n(311));
            const a = {
                popups: { navside: !1, shares: !1 },
                closeOverlay: function () {
                    var t = document.querySelector("body");
                    !1 === this.popups.navside && !1 === this.popups.shares && t.classList.remove("overlayed");
                },
                openOverlay: function () {
                    document.querySelector("body").classList.add("overlayed");
                },
            };
            !(function (t) {
                var e = t(".js-nav-side"),
                    n = t(".js-nav-side-toggle");
                function i() {
                    n.removeClass("active"), e.removeClass("active"), (a.popups.navside = !1), a.closeOverlay();
                }
                document.body,
                    t(document).ready(function () {
                        t(".js-nav-side-toggle").on("click", function (o) {
                            o.preventDefault(), t(this).hasClass("active") ? i() : (n.addClass("active"), e.addClass("active"), (a.popups.navside = !0), a.openOverlay());
                        }),
                            t(document).mouseup(function (t) {
                                e.is(t.target) || n.is(t.target) || 0 !== e.has(t.target).length || i();
                            });
                    });
            })(n(311));
            var c = n(63);
            function u(t) {
                return getComputedStyle(t);
            }
            function f(t, e) {
                for (var n in e) {
                    var i = e[n];
                    "number" == typeof i && (i += "px"), (t.style[n] = i);
                }
                return t;
            }
            function h(t) {
                var e = document.createElement("div");
                return (e.className = t), e;
            }
            document.addEventListener("DOMContentLoaded", function () {
                var t;
                null !== (t = document.querySelectorAll(".js-favorites-add")) &&
                    Array.prototype.forEach.call(t, function (t) {
                        t.onclick = function () {
                            var n = parseInt(t.dataset.id),
                                i = "",
                                o = [],
                                r = e.get("_mygames");
                            if (null == r) o.push(n), (i = JSON.stringify(o)), e.set("_mygames", i, { expires: 7, path: "/" }), (0, c.alert)("Game added");
                            else {
                                var s = JSON.parse(r);
                                -1 == s.indexOf(n) ? (s.push(n), (i = JSON.stringify(s)), e.set("_mygames", i, { expires: 7, path: "/" }), (0, c.alert)("Game added")) : (0, c.alert)("Game already added");
                            }
                            return !1;
                        };
                    });
            }),
                n(77),
                (function (t) {
                    t(document).ready(function () {
                        t(".cs-like-post").on("click", function (e) {
                            e.preventDefault();
                            var n = t(this).data("post");
                            t.post(popig.url, { action: "set_like_post", vote: "like", postID: n, nonce: popig.nonce }).done(function (e) {
                                if (!1 === e.success) (0, c.alert)(e.data.error_message);
                                else {
                                    console.log(e);
                                    var n = "#cs-likes-dislikes-" + e.data.post_id + " .like-count";
                                    t(n).text(e.data.html), (0, c.alert)(e.data.success_message);
                                }
                                clicked = !1;
                            });
                        }),
                            t("a.cs-dislike-post").on("click", function (e) {
                                e.preventDefault();
                                var n = t(this).data("post");
                                t.post(popig.url, { action: "set_dislike_post", vote: "dislike", postID: n, nonce: popig.nonce }).done(function (e) {
                                    if (!1 === e.success) (0, c.alert)(e.data.error_message);
                                    else {
                                        var n = "#cs-likes-dislikes-" + e.data.post_id + " .dislike-count";
                                        t(n).text(e.data.html), (0, c.alert)(e.data.success_message);
                                    }
                                    clicked = !1;
                                });
                            });
                    });
                })(n(311));
            var d = "undefined" != typeof Element && (Element.prototype.matches || Element.prototype.webkitMatchesSelector || Element.prototype.mozMatchesSelector || Element.prototype.msMatchesSelector);
            function p(t, e) {
                if (!d) throw new Error("No element matching method supported");
                return d.call(t, e);
            }
            function v(t) {
                t.remove ? t.remove() : t.parentNode && t.parentNode.removeChild(t);
            }
            function m(t, e) {
                return Array.prototype.filter.call(t.children, function (t) {
                    return p(t, e);
                });
            }
            var g = {
                main: "ps",
                rtl: "ps__rtl",
                element: {
                    thumb: function (t) {
                        return "ps__thumb-" + t;
                    },
                    rail: function (t) {
                        return "ps__rail-" + t;
                    },
                    consuming: "ps__child--consume",
                },
                state: {
                    focus: "ps--focus",
                    clicking: "ps--clicking",
                    active: function (t) {
                        return "ps--active-" + t;
                    },
                    scrolling: function (t) {
                        return "ps--scrolling-" + t;
                    },
                },
            },
                y = { x: null, y: null };
            function _(t, e) {
                var n = t.element.classList,
                    i = g.state.scrolling(e);
                n.contains(i) ? clearTimeout(y[e]) : n.add(i);
            }
            function b(t, e) {
                y[e] = setTimeout(function () {
                    return t.isAlive && t.element.classList.remove(g.state.scrolling(e));
                }, t.settings.scrollingThreshold);
            }
            var w = function (t) {
                (this.element = t), (this.handlers = {});
            },
                C = { isEmpty: { configurable: !0 } };
            (w.prototype.bind = function (t, e) {
                void 0 === this.handlers[t] && (this.handlers[t] = []), this.handlers[t].push(e), this.element.addEventListener(t, e, !1);
            }),
                (w.prototype.unbind = function (t, e) {
                    var n = this;
                    this.handlers[t] = this.handlers[t].filter(function (i) {
                        return !(!e || i === e) || (n.element.removeEventListener(t, i, !1), !1);
                    });
                }),
                (w.prototype.unbindAll = function () {
                    for (var t in this.handlers) this.unbind(t);
                }),
                (C.isEmpty.get = function () {
                    var t = this;
                    return Object.keys(this.handlers).every(function (e) {
                        return 0 === t.handlers[e].length;
                    });
                }),
                Object.defineProperties(w.prototype, C);
            var k = function () {
                this.eventElements = [];
            };
            function x(t) {
                if ("function" == typeof window.CustomEvent) return new CustomEvent(t);
                var e = document.createEvent("CustomEvent");
                return e.initCustomEvent(t, !1, !1, void 0), e;
            }
            function $(t, e, n, i, o) {
                var r;
                if ((void 0 === i && (i = !0), void 0 === o && (o = !1), "top" === e)) r = ["contentHeight", "containerHeight", "scrollTop", "y", "up", "down"];
                else {
                    if ("left" !== e) throw new Error("A proper axis should be provided");
                    r = ["contentWidth", "containerWidth", "scrollLeft", "x", "left", "right"];
                }
                !(function (t, e, n, i, o) {
                    var r = n[0],
                        s = n[1],
                        l = n[2],
                        a = n[3],
                        c = n[4],
                        u = n[5];
                    void 0 === i && (i = !0), void 0 === o && (o = !1);
                    var f = t.element;
                    (t.reach[a] = null),
                        f[l] < 1 && (t.reach[a] = "start"),
                        f[l] > t[r] - t[s] - 1 && (t.reach[a] = "end"),
                        e &&
                        (f.dispatchEvent(x("ps-scroll-" + a)),
                            e < 0 ? f.dispatchEvent(x("ps-scroll-" + c)) : e > 0 && f.dispatchEvent(x("ps-scroll-" + u)),
                            i &&
                            (function (t, e) {
                                _(t, e), b(t, e);
                            })(t, a)),
                        t.reach[a] && (e || o) && f.dispatchEvent(x("ps-" + a + "-reach-" + t.reach[a]));
                })(t, n, r, i, o);
            }
            function E(t) {
                return parseInt(t, 10) || 0;
            }
            (k.prototype.eventElement = function (t) {
                var e = this.eventElements.filter(function (e) {
                    return e.element === t;
                })[0];
                return e || ((e = new w(t)), this.eventElements.push(e)), e;
            }),
                (k.prototype.bind = function (t, e, n) {
                    this.eventElement(t).bind(e, n);
                }),
                (k.prototype.unbind = function (t, e, n) {
                    var i = this.eventElement(t);
                    i.unbind(e, n), i.isEmpty && this.eventElements.splice(this.eventElements.indexOf(i), 1);
                }),
                (k.prototype.unbindAll = function () {
                    this.eventElements.forEach(function (t) {
                        return t.unbindAll();
                    }),
                        (this.eventElements = []);
                }),
                (k.prototype.once = function (t, e, n) {
                    var i = this.eventElement(t),
                        o = function (t) {
                            i.unbind(e, o), n(t);
                        };
                    i.bind(e, o);
                });
            var O = {
                isWebKit: "undefined" != typeof document && "WebkitAppearance" in document.documentElement.style,
                supportsTouch:
                    "undefined" != typeof window && ("ontouchstart" in window || ("maxTouchPoints" in window.navigator && window.navigator.maxTouchPoints > 0) || (window.DocumentTouch && document instanceof window.DocumentTouch)),
                supportsIePointer: "undefined" != typeof navigator && navigator.msMaxTouchPoints,
                isChrome: "undefined" != typeof navigator && /Chrome/i.test(navigator && navigator.userAgent),
            };
            function S(t) {
                var e = t.element,
                    n = Math.floor(e.scrollTop),
                    i = e.getBoundingClientRect();
                (t.containerWidth = Math.round(i.width)),
                    (t.containerHeight = Math.round(i.height)),
                    (t.contentWidth = e.scrollWidth),
                    (t.contentHeight = e.scrollHeight),
                    e.contains(t.scrollbarXRail) ||
                    (m(e, g.element.rail("x")).forEach(function (t) {
                        return v(t);
                    }),
                        e.appendChild(t.scrollbarXRail)),
                    e.contains(t.scrollbarYRail) ||
                    (m(e, g.element.rail("y")).forEach(function (t) {
                        return v(t);
                    }),
                        e.appendChild(t.scrollbarYRail)),
                    !t.settings.suppressScrollX && t.containerWidth + t.settings.scrollXMarginOffset < t.contentWidth
                        ? ((t.scrollbarXActive = !0),
                            (t.railXWidth = t.containerWidth - t.railXMarginWidth),
                            (t.railXRatio = t.containerWidth / t.railXWidth),
                            (t.scrollbarXWidth = L(t, E((t.railXWidth * t.containerWidth) / t.contentWidth))),
                            (t.scrollbarXLeft = E(((t.negativeScrollAdjustment + e.scrollLeft) * (t.railXWidth - t.scrollbarXWidth)) / (t.contentWidth - t.containerWidth))))
                        : (t.scrollbarXActive = !1),
                    !t.settings.suppressScrollY && t.containerHeight + t.settings.scrollYMarginOffset < t.contentHeight
                        ? ((t.scrollbarYActive = !0),
                            (t.railYHeight = t.containerHeight - t.railYMarginHeight),
                            (t.railYRatio = t.containerHeight / t.railYHeight),
                            (t.scrollbarYHeight = L(t, E((t.railYHeight * t.containerHeight) / t.contentHeight))),
                            (t.scrollbarYTop = E((n * (t.railYHeight - t.scrollbarYHeight)) / (t.contentHeight - t.containerHeight))))
                        : (t.scrollbarYActive = !1),
                    t.scrollbarXLeft >= t.railXWidth - t.scrollbarXWidth && (t.scrollbarXLeft = t.railXWidth - t.scrollbarXWidth),
                    t.scrollbarYTop >= t.railYHeight - t.scrollbarYHeight && (t.scrollbarYTop = t.railYHeight - t.scrollbarYHeight),
                    (function (t, e) {
                        var n = { width: e.railXWidth },
                            i = Math.floor(t.scrollTop);
                        e.isRtl ? (n.left = e.negativeScrollAdjustment + t.scrollLeft + e.containerWidth - e.contentWidth) : (n.left = t.scrollLeft),
                            e.isScrollbarXUsingBottom ? (n.bottom = e.scrollbarXBottom - i) : (n.top = e.scrollbarXTop + i),
                            f(e.scrollbarXRail, n);
                        var o = { top: i, height: e.railYHeight };
                        e.isScrollbarYUsingRight
                            ? e.isRtl
                                ? (o.right = e.contentWidth - (e.negativeScrollAdjustment + t.scrollLeft) - e.scrollbarYRight - e.scrollbarYOuterWidth - 9)
                                : (o.right = e.scrollbarYRight - t.scrollLeft)
                            : e.isRtl
                                ? (o.left = e.negativeScrollAdjustment + t.scrollLeft + 2 * e.containerWidth - e.contentWidth - e.scrollbarYLeft - e.scrollbarYOuterWidth)
                                : (o.left = e.scrollbarYLeft + t.scrollLeft),
                            f(e.scrollbarYRail, o),
                            f(e.scrollbarX, { left: e.scrollbarXLeft, width: e.scrollbarXWidth - e.railBorderXWidth }),
                            f(e.scrollbarY, { top: e.scrollbarYTop, height: e.scrollbarYHeight - e.railBorderYWidth });
                    })(e, t),
                    t.scrollbarXActive ? e.classList.add(g.state.active("x")) : (e.classList.remove(g.state.active("x")), (t.scrollbarXWidth = 0), (t.scrollbarXLeft = 0), (e.scrollLeft = !0 === t.isRtl ? t.contentWidth : 0)),
                    t.scrollbarYActive ? e.classList.add(g.state.active("y")) : (e.classList.remove(g.state.active("y")), (t.scrollbarYHeight = 0), (t.scrollbarYTop = 0), (e.scrollTop = 0));
            }
            function L(t, e) {
                return t.settings.minScrollbarLength && (e = Math.max(e, t.settings.minScrollbarLength)), t.settings.maxScrollbarLength && (e = Math.min(e, t.settings.maxScrollbarLength)), e;
            }
            function T(t, e) {
                var n = e[0],
                    i = e[1],
                    o = e[2],
                    r = e[3],
                    s = e[4],
                    l = e[5],
                    a = e[6],
                    c = e[7],
                    u = e[8],
                    f = t.element,
                    h = null,
                    d = null,
                    p = null;
                function v(e) {
                    e.touches && e.touches[0] && (e[o] = e.touches[0].pageY), (f[a] = h + p * (e[o] - d)), _(t, c), S(t), e.stopPropagation(), e.type.startsWith("touch") && e.changedTouches.length > 1 && e.preventDefault();
                }
                function m() {
                    b(t, c), t[u].classList.remove(g.state.clicking), t.event.unbind(t.ownerDocument, "mousemove", v);
                }
                function y(e, s) {
                    (h = f[a]),
                        s && e.touches && (e[o] = e.touches[0].pageY),
                        (d = e[o]),
                        (p = (t[i] - t[n]) / (t[r] - t[l])),
                        s ? t.event.bind(t.ownerDocument, "touchmove", v) : (t.event.bind(t.ownerDocument, "mousemove", v), t.event.once(t.ownerDocument, "mouseup", m), e.preventDefault()),
                        t[u].classList.add(g.state.clicking),
                        e.stopPropagation();
                }
                t.event.bind(t[s], "mousedown", function (t) {
                    y(t);
                }),
                    t.event.bind(t[s], "touchstart", function (t) {
                        y(t, !0);
                    });
            }
            var P = {
                "click-rail": function (t) {
                    t.element,
                        t.event.bind(t.scrollbarY, "mousedown", function (t) {
                            return t.stopPropagation();
                        }),
                        t.event.bind(t.scrollbarYRail, "mousedown", function (e) {
                            var n = e.pageY - window.pageYOffset - t.scrollbarYRail.getBoundingClientRect().top > t.scrollbarYTop ? 1 : -1;
                            (t.element.scrollTop += n * t.containerHeight), S(t), e.stopPropagation();
                        }),
                        t.event.bind(t.scrollbarX, "mousedown", function (t) {
                            return t.stopPropagation();
                        }),
                        t.event.bind(t.scrollbarXRail, "mousedown", function (e) {
                            var n = e.pageX - window.pageXOffset - t.scrollbarXRail.getBoundingClientRect().left > t.scrollbarXLeft ? 1 : -1;
                            (t.element.scrollLeft += n * t.containerWidth), S(t), e.stopPropagation();
                        });
                },
                "drag-thumb": function (t) {
                    T(t, ["containerWidth", "contentWidth", "pageX", "railXWidth", "scrollbarX", "scrollbarXWidth", "scrollLeft", "x", "scrollbarXRail"]),
                        T(t, ["containerHeight", "contentHeight", "pageY", "railYHeight", "scrollbarY", "scrollbarYHeight", "scrollTop", "y", "scrollbarYRail"]);
                },
                keyboard: function (t) {
                    var e = t.element;
                    t.event.bind(t.ownerDocument, "keydown", function (n) {
                        if (!((n.isDefaultPrevented && n.isDefaultPrevented()) || n.defaultPrevented) && (p(e, ":hover") || p(t.scrollbarX, ":focus") || p(t.scrollbarY, ":focus"))) {
                            var i,
                                o = document.activeElement ? document.activeElement : t.ownerDocument.activeElement;
                            if (o) {
                                if ("IFRAME" === o.tagName) o = o.contentDocument.activeElement;
                                else for (; o.shadowRoot;) o = o.shadowRoot.activeElement;
                                if (p((i = o), "input,[contenteditable]") || p(i, "select,[contenteditable]") || p(i, "textarea,[contenteditable]") || p(i, "button,[contenteditable]")) return;
                            }
                            var r = 0,
                                s = 0;
                            switch (n.which) {
                                case 37:
                                    r = n.metaKey ? -t.contentWidth : n.altKey ? -t.containerWidth : -30;
                                    break;
                                case 38:
                                    s = n.metaKey ? t.contentHeight : n.altKey ? t.containerHeight : 30;
                                    break;
                                case 39:
                                    r = n.metaKey ? t.contentWidth : n.altKey ? t.containerWidth : 30;
                                    break;
                                case 40:
                                    s = n.metaKey ? -t.contentHeight : n.altKey ? -t.containerHeight : -30;
                                    break;
                                case 32:
                                    s = n.shiftKey ? t.containerHeight : -t.containerHeight;
                                    break;
                                case 33:
                                    s = t.containerHeight;
                                    break;
                                case 34:
                                    s = -t.containerHeight;
                                    break;
                                case 36:
                                    s = t.contentHeight;
                                    break;
                                case 35:
                                    s = -t.contentHeight;
                                    break;
                                default:
                                    return;
                            }
                            (t.settings.suppressScrollX && 0 !== r) ||
                                (t.settings.suppressScrollY && 0 !== s) ||
                                ((e.scrollTop -= s),
                                    (e.scrollLeft += r),
                                    S(t),
                                    (function (n, i) {
                                        var o = Math.floor(e.scrollTop);
                                        if (0 === n) {
                                            if (!t.scrollbarYActive) return !1;
                                            if ((0 === o && i > 0) || (o >= t.contentHeight - t.containerHeight && i < 0)) return !t.settings.wheelPropagation;
                                        }
                                        var r = e.scrollLeft;
                                        if (0 === i) {
                                            if (!t.scrollbarXActive) return !1;
                                            if ((0 === r && n < 0) || (r >= t.contentWidth - t.containerWidth && n > 0)) return !t.settings.wheelPropagation;
                                        }
                                        return !0;
                                    })(r, s) && n.preventDefault());
                        }
                    });
                },
                wheel: function (t) {
                    var e = t.element;
                    function n(n) {
                        var i = (function (t) {
                            var e = t.deltaX,
                                n = -1 * t.deltaY;
                            return (
                                (void 0 !== e && void 0 !== n) || ((e = (-1 * t.wheelDeltaX) / 6), (n = t.wheelDeltaY / 6)),
                                t.deltaMode && 1 === t.deltaMode && ((e *= 10), (n *= 10)),
                                e != e && n != n && ((e = 0), (n = t.wheelDelta)),
                                t.shiftKey ? [-n, -e] : [e, n]
                            );
                        })(n),
                            o = i[0],
                            r = i[1];
                        if (
                            !(function (t, n, i) {
                                if (!O.isWebKit && e.querySelector("select:focus")) return !0;
                                if (!e.contains(t)) return !1;
                                for (var o = t; o && o !== e;) {
                                    if (o.classList.contains(g.element.consuming)) return !0;
                                    var r = u(o);
                                    if (i && r.overflowY.match(/(scroll|auto)/)) {
                                        var s = o.scrollHeight - o.clientHeight;
                                        if (s > 0 && ((o.scrollTop > 0 && i < 0) || (o.scrollTop < s && i > 0))) return !0;
                                    }
                                    if (n && r.overflowX.match(/(scroll|auto)/)) {
                                        var l = o.scrollWidth - o.clientWidth;
                                        if (l > 0 && ((o.scrollLeft > 0 && n < 0) || (o.scrollLeft < l && n > 0))) return !0;
                                    }
                                    o = o.parentNode;
                                }
                                return !1;
                            })(n.target, o, r)
                        ) {
                            var s = !1;
                            t.settings.useBothWheelAxes
                                ? t.scrollbarYActive && !t.scrollbarXActive
                                    ? (r ? (e.scrollTop -= r * t.settings.wheelSpeed) : (e.scrollTop += o * t.settings.wheelSpeed), (s = !0))
                                    : t.scrollbarXActive && !t.scrollbarYActive && (o ? (e.scrollLeft += o * t.settings.wheelSpeed) : (e.scrollLeft -= r * t.settings.wheelSpeed), (s = !0))
                                : ((e.scrollTop -= r * t.settings.wheelSpeed), (e.scrollLeft += o * t.settings.wheelSpeed)),
                                S(t),
                                (s =
                                    s ||
                                    (function (n, i) {
                                        var o = Math.floor(e.scrollTop),
                                            r = 0 === e.scrollTop,
                                            s = o + e.offsetHeight === e.scrollHeight,
                                            l = 0 === e.scrollLeft,
                                            a = e.scrollLeft + e.offsetWidth === e.scrollWidth;
                                        return !(Math.abs(i) > Math.abs(n) ? r || s : l || a) || !t.settings.wheelPropagation;
                                    })(o, r)),
                                s && !n.ctrlKey && (n.stopPropagation(), n.preventDefault());
                        }
                    }
                    void 0 !== window.onwheel ? t.event.bind(e, "wheel", n) : void 0 !== window.onmousewheel && t.event.bind(e, "mousewheel", n);
                },
                touch: function (t) {
                    if (O.supportsTouch || O.supportsIePointer) {
                        var e = t.element,
                            n = {},
                            i = 0,
                            o = {},
                            r = null;
                        O.supportsTouch
                            ? (t.event.bind(e, "touchstart", c), t.event.bind(e, "touchmove", f), t.event.bind(e, "touchend", h))
                            : O.supportsIePointer &&
                            (window.PointerEvent
                                ? (t.event.bind(e, "pointerdown", c), t.event.bind(e, "pointermove", f), t.event.bind(e, "pointerup", h))
                                : window.MSPointerEvent && (t.event.bind(e, "MSPointerDown", c), t.event.bind(e, "MSPointerMove", f), t.event.bind(e, "MSPointerUp", h)));
                    }
                    function s(n, i) {
                        (e.scrollTop -= i), (e.scrollLeft -= n), S(t);
                    }
                    function l(t) {
                        return t.targetTouches ? t.targetTouches[0] : t;
                    }
                    function a(t) {
                        return !(
                            (t.pointerType && "pen" === t.pointerType && 0 === t.buttons) ||
                            ((!t.targetTouches || 1 !== t.targetTouches.length) && (!t.pointerType || "mouse" === t.pointerType || t.pointerType === t.MSPOINTER_TYPE_MOUSE))
                        );
                    }
                    function c(t) {
                        if (a(t)) {
                            var e = l(t);
                            (n.pageX = e.pageX), (n.pageY = e.pageY), (i = new Date().getTime()), null !== r && clearInterval(r);
                        }
                    }
                    function f(r) {
                        if (a(r)) {
                            var c = l(r),
                                f = { pageX: c.pageX, pageY: c.pageY },
                                h = f.pageX - n.pageX,
                                d = f.pageY - n.pageY;
                            if (
                                (function (t, n, i) {
                                    if (!e.contains(t)) return !1;
                                    for (var o = t; o && o !== e;) {
                                        if (o.classList.contains(g.element.consuming)) return !0;
                                        var r = u(o);
                                        if (i && r.overflowY.match(/(scroll|auto)/)) {
                                            var s = o.scrollHeight - o.clientHeight;
                                            if (s > 0 && ((o.scrollTop > 0 && i < 0) || (o.scrollTop < s && i > 0))) return !0;
                                        }
                                        if (n && r.overflowX.match(/(scroll|auto)/)) {
                                            var l = o.scrollWidth - o.clientWidth;
                                            if (l > 0 && ((o.scrollLeft > 0 && n < 0) || (o.scrollLeft < l && n > 0))) return !0;
                                        }
                                        o = o.parentNode;
                                    }
                                    return !1;
                                })(r.target, h, d)
                            )
                                return;
                            s(h, d), (n = f);
                            var p = new Date().getTime(),
                                v = p - i;
                            v > 0 && ((o.x = h / v), (o.y = d / v), (i = p)),
                                (function (n, i) {
                                    var o = Math.floor(e.scrollTop),
                                        r = e.scrollLeft,
                                        s = Math.abs(n),
                                        l = Math.abs(i);
                                    if (l > s) {
                                        if ((i < 0 && o === t.contentHeight - t.containerHeight) || (i > 0 && 0 === o)) return 0 === window.scrollY && i > 0 && O.isChrome;
                                    } else if (s > l && ((n < 0 && r === t.contentWidth - t.containerWidth) || (n > 0 && 0 === r))) return !0;
                                    return !0;
                                })(h, d) && r.preventDefault();
                        }
                    }
                    function h() {
                        t.settings.swipeEasing &&
                            (clearInterval(r),
                                (r = setInterval(function () {
                                    t.isInitialized
                                        ? clearInterval(r)
                                        : o.x || o.y
                                            ? Math.abs(o.x) < 0.01 && Math.abs(o.y) < 0.01
                                                ? clearInterval(r)
                                                : t.element
                                                    ? (s(30 * o.x, 30 * o.y), (o.x *= 0.8), (o.y *= 0.8))
                                                    : clearInterval(r)
                                            : clearInterval(r);
                                }, 10)));
                    }
                },
            },
                M = function (t, e) {
                    var n = this;
                    if ((void 0 === e && (e = {}), "string" == typeof t && (t = document.querySelector(t)), !t || !t.nodeName)) throw new Error("no element is specified to initialize PerfectScrollbar");
                    for (var i in ((this.element = t),
                        t.classList.add(g.main),
                        (this.settings = {
                            handlers: ["click-rail", "drag-thumb", "keyboard", "wheel", "touch"],
                            maxScrollbarLength: null,
                            minScrollbarLength: null,
                            scrollingThreshold: 1e3,
                            scrollXMarginOffset: 0,
                            scrollYMarginOffset: 0,
                            suppressScrollX: !1,
                            suppressScrollY: !1,
                            swipeEasing: !0,
                            useBothWheelAxes: !1,
                            wheelPropagation: !0,
                            wheelSpeed: 1,
                        }),
                        e))
                        this.settings[i] = e[i];
                    (this.containerWidth = null), (this.containerHeight = null), (this.contentWidth = null), (this.contentHeight = null);
                    var o,
                        r,
                        s = function () {
                            return t.classList.add(g.state.focus);
                        },
                        l = function () {
                            return t.classList.remove(g.state.focus);
                        };
                    (this.isRtl = "rtl" === u(t).direction),
                        !0 === this.isRtl && t.classList.add(g.rtl),
                        (this.isNegativeScroll = ((r = t.scrollLeft), (t.scrollLeft = -1), (o = t.scrollLeft < 0), (t.scrollLeft = r), o)),
                        (this.negativeScrollAdjustment = this.isNegativeScroll ? t.scrollWidth - t.clientWidth : 0),
                        (this.event = new k()),
                        (this.ownerDocument = t.ownerDocument || document),
                        (this.scrollbarXRail = h(g.element.rail("x"))),
                        t.appendChild(this.scrollbarXRail),
                        (this.scrollbarX = h(g.element.thumb("x"))),
                        this.scrollbarXRail.appendChild(this.scrollbarX),
                        this.scrollbarX.setAttribute("tabindex", 0),
                        this.event.bind(this.scrollbarX, "focus", s),
                        this.event.bind(this.scrollbarX, "blur", l),
                        (this.scrollbarXActive = null),
                        (this.scrollbarXWidth = null),
                        (this.scrollbarXLeft = null);
                    var a = u(this.scrollbarXRail);
                    (this.scrollbarXBottom = parseInt(a.bottom, 10)),
                        isNaN(this.scrollbarXBottom) ? ((this.isScrollbarXUsingBottom = !1), (this.scrollbarXTop = E(a.top))) : (this.isScrollbarXUsingBottom = !0),
                        (this.railBorderXWidth = E(a.borderLeftWidth) + E(a.borderRightWidth)),
                        f(this.scrollbarXRail, { display: "block" }),
                        (this.railXMarginWidth = E(a.marginLeft) + E(a.marginRight)),
                        f(this.scrollbarXRail, { display: "" }),
                        (this.railXWidth = null),
                        (this.railXRatio = null),
                        (this.scrollbarYRail = h(g.element.rail("y"))),
                        t.appendChild(this.scrollbarYRail),
                        (this.scrollbarY = h(g.element.thumb("y"))),
                        this.scrollbarYRail.appendChild(this.scrollbarY),
                        this.scrollbarY.setAttribute("tabindex", 0),
                        this.event.bind(this.scrollbarY, "focus", s),
                        this.event.bind(this.scrollbarY, "blur", l),
                        (this.scrollbarYActive = null),
                        (this.scrollbarYHeight = null),
                        (this.scrollbarYTop = null);
                    var c = u(this.scrollbarYRail);
                    (this.scrollbarYRight = parseInt(c.right, 10)),
                        isNaN(this.scrollbarYRight) ? ((this.isScrollbarYUsingRight = !1), (this.scrollbarYLeft = E(c.left))) : (this.isScrollbarYUsingRight = !0),
                        (this.scrollbarYOuterWidth = this.isRtl
                            ? (function (t) {
                                var e = u(t);
                                return E(e.width) + E(e.paddingLeft) + E(e.paddingRight) + E(e.borderLeftWidth) + E(e.borderRightWidth);
                            })(this.scrollbarY)
                            : null),
                        (this.railBorderYWidth = E(c.borderTopWidth) + E(c.borderBottomWidth)),
                        f(this.scrollbarYRail, { display: "block" }),
                        (this.railYMarginHeight = E(c.marginTop) + E(c.marginBottom)),
                        f(this.scrollbarYRail, { display: "" }),
                        (this.railYHeight = null),
                        (this.railYRatio = null),
                        (this.reach = {
                            x: t.scrollLeft <= 0 ? "start" : t.scrollLeft >= this.contentWidth - this.containerWidth ? "end" : null,
                            y: t.scrollTop <= 0 ? "start" : t.scrollTop >= this.contentHeight - this.containerHeight ? "end" : null,
                        }),
                        (this.isAlive = !0),
                        this.settings.handlers.forEach(function (t) {
                            return P[t](n);
                        }),
                        (this.lastScrollTop = Math.floor(t.scrollTop)),
                        (this.lastScrollLeft = t.scrollLeft),
                        this.event.bind(this.element, "scroll", function (t) {
                            return n.onScroll(t);
                        }),
                        S(this);
                };
            (M.prototype.update = function () {
                this.isAlive &&
                    ((this.negativeScrollAdjustment = this.isNegativeScroll ? this.element.scrollWidth - this.element.clientWidth : 0),
                        f(this.scrollbarXRail, { display: "block" }),
                        f(this.scrollbarYRail, { display: "block" }),
                        (this.railXMarginWidth = E(u(this.scrollbarXRail).marginLeft) + E(u(this.scrollbarXRail).marginRight)),
                        (this.railYMarginHeight = E(u(this.scrollbarYRail).marginTop) + E(u(this.scrollbarYRail).marginBottom)),
                        f(this.scrollbarXRail, { display: "none" }),
                        f(this.scrollbarYRail, { display: "none" }),
                        S(this),
                        $(this, "top", 0, !1, !0),
                        $(this, "left", 0, !1, !0),
                        f(this.scrollbarXRail, { display: "" }),
                        f(this.scrollbarYRail, { display: "" }));
            }),
                (M.prototype.onScroll = function (t) {
                    this.isAlive &&
                        (S(this),
                            $(this, "top", this.element.scrollTop - this.lastScrollTop),
                            $(this, "left", this.element.scrollLeft - this.lastScrollLeft),
                            (this.lastScrollTop = Math.floor(this.element.scrollTop)),
                            (this.lastScrollLeft = this.element.scrollLeft));
                }),
                (M.prototype.destroy = function () {
                    this.isAlive &&
                        (this.event.unbindAll(),
                            v(this.scrollbarX),
                            v(this.scrollbarY),
                            v(this.scrollbarXRail),
                            v(this.scrollbarYRail),
                            this.removePsClasses(),
                            (this.element = null),
                            (this.scrollbarX = null),
                            (this.scrollbarY = null),
                            (this.scrollbarXRail = null),
                            (this.scrollbarYRail = null),
                            (this.isAlive = !1));
                }),
                (M.prototype.removePsClasses = function () {
                    this.element.className = this.element.className
                        .split(" ")
                        .filter(function (t) {
                            return !t.match(/^ps([-_].+|)$/);
                        })
                        .join(" ");
                });
            const A = M;
            var H;
            function N() {
                return H || (H = Promise.resolve(void 0));
            }
            n(311)(function (t) {
                t(".comments-list__wrapper").each(function () {
                    var e = new A(".comments-list__wrapper", { wheelPropagation: !1 });
                    t(".js-load-comments").on("click", function (n) {
                        n.preventDefault();
                        var i = t(this),
                            o = i.data("current"),
                            r = i.data("post");
                        return (
                            o++,
                            t.ajax({
                                url: fsPoppif.url,
                                data: { action: "cloadmore", post_id: r, cpage: o },
                                type: "POST",
                                beforeSend: function (t) {
                                    i.text("Loading...");
                                },
                                success: function (e) {
                                    e ? (t("ol.comments-list").append(e), i.text("Load oldest"), i.data("current", o), 1 == o && i.remove()) : i.remove();
                                },
                            }),
                            e.update(),
                            !1
                        );
                    });
                });
            });
            var R = class {
                constructor() {
                    this.promise = new Promise((t, e) => {
                        (this.resolve = t), (this.reject = e);
                    });
                }
            };
            function D(t) {
                const e = Object.getOwnPropertyDescriptor(t, "message");
                if (null != e && e.writable) return t;
                const { message: n, stack: i } = t,
                    o = new Error(n);
                for (const e in t) o[e] = t[e];
                return (o.stack = i), o;
            }
            function j(t) {
                let e = null,
                    n = "";
                for (const t of arguments) t instanceof Error && !e ? (e = D(t)) : (n && (n += " "), (n += t));
                return e ? n && (e.message = n + ": " + e.message) : (e = new Error(n)), e;
            }
            function W(t) {
                const e = j.apply(null, arguments);
                setTimeout(() => {
                    throw (
                        ((function (t) {
                            var e, n;
                            null === (e = (n = self).__AMP_REPORT_ERROR) || void 0 === e || e.call(n, t);
                        })(e),
                            e)
                    );
                });
            }
            function Y(t, ...e) {
                try {
                    return t.apply(null, e);
                } catch (t) {
                    W(t);
                }
            }
            var { hasOwnProperty: I, toString: X } = Object.prototype,
                { isArray: F } = Array;
            function B(t) {
                return F(t) ? t : [t];
            }
            function V(t, e) {
                return t.indexOf(e) < 0 && (t.push(e), !0);
            }
            function U(t, e) {
                const n = t.indexOf(e);
                return -1 != n && (t.splice(n, 1), !0);
            }
            function z(t) {
                return 1 == (null == t ? void 0 : t.nodeType);
            }
            function q(t, e, n, i, o, r, s, l, a, c, u) {
                return t;
            }
            function G(t, e) {
                let n = !1;
                const i = () => {
                    (n = !1), t();
                };
                return (t) => {
                    n || ((n = !0), (t || e)(i));
                };
            }
            function Z(t, e, n, i = !0, o = !0) {
                if (o) {
                    const o = e(t, n, i);
                    o && Z(t, e, n, o, !1);
                } else if (t.children) for (const o of t.children) Z(o, e, n, i, !0);
            }
            var K = [],
                J = () => { };
            function Q(t, e) {
                return t.values.scan(e);
            }
            function tt(t, e, n) {
                return t.values.scanAll(n);
            }
            function et(t, e) {
                return t.values.has(e);
            }
            function nt(t) {
                return !!t.recursive;
            }
            function it(t) {
                return void 0 !== t;
            }
            var ot = class {
                static get(t) {
                    let e = t.__AMP_NODE;
                    return e || ((e = new ot(t, null)), (t.__AMP_NODE = e)), e;
                }
                static closest(t, e = !0) {
                    let n = t;
                    for (; n;) {
                        if (n != t || e) {
                            if (n.__AMP_NODE) return n.__AMP_NODE;
                            const { nodeType: t } = n;
                            if (9 == t || 11 == t || (z(n) && n.tagName.startsWith("AMP-"))) return ot.get(n);
                        }
                        n = n.__AMP_ASSIGNED_SLOT || n.assignedSlot || n.parentNode;
                    }
                    return null;
                }
                static assignSlot(t, e) {
                    t.__AMP_ASSIGNED_SLOT != e && ((t.__AMP_ASSIGNED_SLOT = e), rt(t));
                }
                static unassignSlot(t, e) {
                    t.__AMP_ASSIGNED_SLOT == e && ((t.__AMP_ASSIGNED_SLOT = void 0), rt(t));
                }
                static rediscoverChildren(t) {
                    var e;
                    const n = t.__AMP_NODE;
                    null == n || null === (e = n.children) || void 0 === e || e.forEach(st);
                }
                constructor(t, e) {
                    (this.node = t),
                        (this.name = e),
                        (this.isRoot = 9 == t.nodeType),
                        (this.root = this.isRoot ? this : null),
                        (this.parent = null),
                        (this.children = null),
                        (this.groups = null),
                        (this.values = new (class {
                            constructor(t) {
                                (this.i = t), (this.o = null), (this.u = null), (this.h = G(this.h.bind(this), setTimeout));
                            }
                            set(t, e, n) {
                                q(e), q(void 0 !== n);
                                const { key: i } = t,
                                    o = this.o || (this.o = new Map());
                                let r = o.get(i);
                                r || ((r = { values: [], setters: [] }), o.set(i, r));
                                const s = r.setters.indexOf(e),
                                    l = -1 == s || r.values[s] !== n;
                                -1 == s ? (r.setters.push(e), r.values.push(n)) : l && (r.values[s] = n), l && (this.ping(t, !1), nt(t) && Z(this.i, Q, t, !0, !1));
                            }
                            remove(t, e) {
                                q(e);
                                const { key: n } = t,
                                    i = this.o,
                                    o = null == i ? void 0 : i.get(n);
                                if (o) {
                                    q(i);
                                    const r = o.setters.indexOf(e);
                                    -1 != r && (o.setters.splice(r, 1), o.values.splice(r, 1), 0 == o.setters.length && i.delete(n), Z(this.i, Q, t));
                                }
                            }
                            has(t) {
                                var e;
                                return !(null === (e = this.o) || void 0 === e || !e.has(t.key));
                            }
                            subscribe(t, e) {
                                const n = this.v(t);
                                if (!V(n.subscribers, e)) return;
                                const i = n.value;
                                it(i) && this.p() && e(i);
                            }
                            unsubscribe(t, e) {
                                var n;
                                const i = null === (n = this.u) || void 0 === n ? void 0 : n.get(t.key);
                                i && U(i.subscribers, e) && this.m(i);
                            }
                            ping(t, e) {
                                var n, i;
                                null === (n = this.u) || void 0 === n || null === (i = n.get(t.key)) || void 0 === i || i.ping(e);
                            }
                            parentUpdated() {
                                this.p() && Z(this.i, tt, void 0, K);
                            }
                            rootUpdated() {
                                const t = this.u;
                                t &&
                                    (this.p()
                                        ? t.forEach((t) => {
                                            const { prop: e } = t;
                                            this.ping(e, !0);
                                        })
                                        : t.forEach((t) => {
                                            const { prop: e } = t;
                                            nt(e) && this._(t, null);
                                        }));
                            }
                            scan(t) {
                                return this.ping(t, !0), !!nt(t) && !this.has(t);
                            }
                            scanAll(t) {
                                let e = null;
                                const n = this.u;
                                return (
                                    n &&
                                    n.forEach((n) => {
                                        const { prop: i } = n,
                                            { key: o } = i;
                                        -1 == (e || t).indexOf(o) && (this.ping(i, !0), this.i.children && this.has(i) && (e || (e = t.slice(0)), e.push(o)));
                                    }),
                                    e || t
                                );
                            }
                            p() {
                                return !!this.i.root;
                            }
                            v(t) {
                                const { deps: e, key: n } = t,
                                    i = this.u || (this.u = new Map());
                                let o = i.get(n);
                                return (
                                    o ||
                                    ((o = {
                                        prop: t,
                                        subscribers: [],
                                        value: void 0,
                                        pending: 0,
                                        counter: 0,
                                        depValues: e.length > 0 ? e.map(J) : K,
                                        parentValue: void 0,
                                        parentContextNode: null,
                                        ping: (t) => {
                                            if (this.p()) {
                                                const e = t ? 2 : 1;
                                                (o.pending = Math.max(o.pending, e)), this.h();
                                            }
                                        },
                                        pingDep:
                                            e.length > 0
                                                ? e.map((t, e) => (t) => {
                                                    (o.depValues[e] = t), o.ping();
                                                })
                                                : K,
                                        pingParent: nt(t)
                                            ? (t) => {
                                                (o.parentValue = t), o.ping();
                                            }
                                            : null,
                                    }),
                                        i.set(n, o),
                                        e.forEach((t, e) => this.subscribe(t, o.pingDep[e])),
                                        o.ping(!1)),
                                    o
                                );
                            }
                            m(t) {
                                var e;
                                if (t.subscribers.length > 0) return;
                                const { pingDep: n, prop: i } = t,
                                    { deps: o, key: r } = i;
                                null === (e = this.u) || void 0 === e || e.delete(r),
                                    this._(t, null),
                                    o.length > 0 &&
                                    o.forEach((t, e) => {
                                        this.unsubscribe(t, n[e]);
                                    });
                            }
                            h() {
                                if (!this.p()) return;
                                const t = this.u;
                                if (!t) return;
                                let e;
                                t.forEach((t) => {
                                    t.counter = 0;
                                });
                                do {
                                    (e = 0),
                                        t.forEach((t) => {
                                            if (0 != t.pending) {
                                                const { key: n } = t.prop;
                                                if ((t.counter++, t.counter > 5)) return W(`cyclical prop: ${n}`), void (t.pending = 0);
                                                e++, this.g(t);
                                            }
                                        });
                                } while (e > 0);
                            }
                            g(t) {
                                const e = 2 == t.pending;
                                let n;
                                try {
                                    n = this.P(t, e);
                                } catch (t) {
                                    W(t);
                                }
                                (t.pending = 0), this.A(t, n);
                            }
                            A(t, e) {
                                const { prop: n, value: i } = t,
                                    { key: o } = n,
                                    r = this.u;
                                if (i === e || t !== (null == r ? void 0 : r.get(o)) || !this.p()) return;
                                t.value = e;
                                const { subscribers: s } = t;
                                for (const t of s) t(e);
                            }
                            P(t, e) {
                                var n, i;
                                q(this.p());
                                const { depValues: o, prop: r } = t,
                                    { compute: s, defaultValue: l, key: a } = r,
                                    c = null === (n = this.o) || void 0 === n || null === (i = n.get(a)) || void 0 === i ? void 0 : i.values,
                                    u = (function (t, e) {
                                        const { compute: n, recursive: i } = t;
                                        return "function" == typeof i ? !e || i(e) : !(i && e && !n) && i;
                                    })(r, c);
                                if (e || u != Boolean(t.parentContextNode)) {
                                    const e = u
                                        ? (function (t, e, n, i = !0) {
                                            for (let o = i ? t : t.parent; o; o = o.parent) if (e(o, n)) return o;
                                            return null;
                                        })(this.i, et, r, !1)
                                        : null;
                                    this._(t, e);
                                }
                                const f = it(t.parentValue) ? t.parentValue : u && !t.parentContextNode ? l : void 0;
                                let h;
                                if (o.every(it) && (!u || it(f))) {
                                    const { node: t } = this.i;
                                    c && !s
                                        ? (h = c[0])
                                        : nt(r)
                                            ? c || o.length > 0
                                                ? (h = (function (t, e, n, i, o) {
                                                    switch (o.length) {
                                                        case 0:
                                                            return t(e, n, i);
                                                        case 1:
                                                            return t(e, n, i, o[0]);
                                                        case 2:
                                                            return t(e, n, i, o[0], o[1]);
                                                        case 3:
                                                            return t(e, n, i, o[0], o[1], o[2]);
                                                        default:
                                                            return t.apply(null, [e, n, i].concat(o));
                                                    }
                                                })(s, t, c || K, f, o))
                                                : it(f) && (h = f)
                                            : s &&
                                            (h = (function (t, e, n, i) {
                                                switch (i.length) {
                                                    case 0:
                                                        return t(e, n);
                                                    case 1:
                                                        return t(e, n, i[0]);
                                                    case 2:
                                                        return t(e, n, i[0], i[1]);
                                                    case 3:
                                                        return t(e, n, i[0], i[1], i[2]);
                                                    default:
                                                        return t.apply(null, [e, n].concat(i));
                                                }
                                            })(s, t, c || K, o));
                                }
                                return h;
                            }
                            _(t, e) {
                                const { parentContextNode: n, pingParent: i, prop: o } = t;
                                e != n && ((t.parentContextNode = e), (t.parentValue = void 0), q(i), n && n.values.unsubscribe(o, i), e && (q(i), e.values.subscribe(o, i)));
                            }
                        })(this)),
                        (this.k = null),
                        (this.M = !1),
                        (this.R = G(this.S.bind(this), setTimeout)),
                        11 == t.nodeType &&
                        t.addEventListener("slotchange", (t) => {
                            var e, n;
                            const i = t.target;
                            i.assignedNodes().forEach(rt), null === (e = ot.closest(i)) || void 0 === e || null === (n = e.children) || void 0 === n || n.forEach(st);
                        }),
                        this.discover();
                }
                discover() {
                    this.isDiscoverable() ? this.R() : this.name && this.children && this.children.forEach(st);
                }
                isDiscoverable() {
                    return !this.isRoot && !this.M;
                }
                setParent(t) {
                    const e = null != t && t.nodeType ? ot.get(t) : t;
                    this.T(e, null != t);
                }
                setIsRoot(t) {
                    var e, n;
                    this.isRoot = t;
                    const i = t ? this : null !== (e = null === (n = this.parent) || void 0 === n ? void 0 : n.root) && void 0 !== e ? e : null;
                    this.updateRoot(i);
                }
                updateRoot(t) {
                    q(!t || t.isRoot);
                    const e = this.root;
                    var n, i;
                    t != e && ((this.root = t), this.values.rootUpdated(), null === (n = this.k) || void 0 === n || n.forEach((t) => t.rootUpdated()), null === (i = this.children) || void 0 === i || i.forEach((e) => e.updateRoot(t)));
                }
                addGroup(t, e, n) {
                    const i = this.groups || (this.groups = new Map()),
                        { children: o, node: r } = this,
                        s = new ot(r, t);
                    return i.set(t, { cn: s, match: e, weight: n }), s.setParent(this), null == o || o.forEach(st), s;
                }
                group(t) {
                    var e, n;
                    return (null === (e = this.groups) || void 0 === e || null === (n = e.get(t)) || void 0 === n ? void 0 : n.cn) || null;
                }
                findGroup(t) {
                    const { groups: e } = this;
                    if (!e) return null;
                    let n = null,
                        i = Number.NEGATIVE_INFINITY;
                    return (
                        e.forEach(({ cn: e, match: o, weight: r }) => {
                            o(t, this.node) && r > i && ((n = e), (i = r));
                        }),
                        n
                    );
                }
                subscribe(t, e, n, i) {
                    const o = this.k || (this.k = new Map());
                    let r = o.get(t);
                    r || ((r = new e(this, n, i)), o.set(t, r));
                }
                unsubscribe(t) {
                    const e = this.k,
                        n = null == e ? void 0 : e.get(t);
                    n && (n.dispose(), q(e), e.delete(t));
                }
                S() {
                    if (!this.isDiscoverable()) return;
                    const t = ot.closest(this.node, !1),
                        e = (null == t ? void 0 : t.findGroup(this.node)) || t;
                    this.T(e, !1);
                }
                T(t, e) {
                    var n;
                    this.M = e;
                    const i = this.parent;
                    if (t != i) {
                        if (((this.parent = t), null != i && i.children && (q(i.children), U(i.children, this)), t)) {
                            const e = t.children || (t.children = []);
                            V(e, this);
                            for (const t of e) t != this && t.isDiscoverable() && t.discover();
                        }
                        this.values.parentUpdated();
                    }
                    this.updateRoot(null !== (n = null == t ? void 0 : t.root) && void 0 !== n ? n : null);
                }
            };
            function rt(t) {
                !(function (t, e, n = !0) {
                    const i = ot.closest(t, n);
                    if (i)
                        if (i.node == t) e(i);
                        else if (i.children) for (const n of i.children) t.contains(n.node) && e(n);
                })(t, st);
            }
            function st(t) {
                t.discover();
            }
            function lt(t, e, n) {
                return e in t ? Object.defineProperty(t, e, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : (t[e] = n), t;
            }
            function at(t, e) {
                var n = Object.keys(t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(t);
                    e &&
                        (i = i.filter(function (e) {
                            return Object.getOwnPropertyDescriptor(t, e).enumerable;
                        })),
                        n.push.apply(n, i);
                }
                return n;
            }
            function ct(t) {
                for (var e = 1; e < arguments.length; e++) {
                    var n = null != arguments[e] ? arguments[e] : {};
                    e % 2
                        ? at(Object(n), !0).forEach(function (e) {
                            lt(t, e, n[e]);
                        })
                        : Object.getOwnPropertyDescriptors
                            ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(n))
                            : at(Object(n)).forEach(function (e) {
                                Object.defineProperty(t, e, Object.getOwnPropertyDescriptor(n, e));
                            });
                }
                return t;
            }
            var ut = [];
            function ft(t, e) {
                const n = ct({ key: t, deps: ut, recursive: !1 }, e);
                return q(0 == n.deps.length || n.compute), n;
            }
            var ht = [],
                dt = () => { };
            function pt(t, e, n) {
                e = B(e);
                const i = n;
                ot.get(t).subscribe(i, Ct, n, e);
            }
            var vt,
                mt,
                gt,
                yt,
                _t,
                bt,
                wt,
                Ct = class {
                    constructor(t, e, n) {
                        if (
                            ((this.contextNode = t),
                                (this.V = e),
                                (this.C = n),
                                (this.I = n.length > 0 ? n.map(dt) : ht),
                                (this.O =
                                    n.length > 0
                                        ? n.map((t, e) => (t) => {
                                            (this.I[e] = t), this.j();
                                        })
                                        : ht),
                                (this.N = !1),
                                (this.$ = null),
                                (this.j = G(this.j.bind(this), setTimeout)),
                                n.length > 0)
                        ) {
                            const { values: t } = this.contextNode;
                            n.forEach((e, n) => t.subscribe(e, this.O[n]));
                        }
                        this.p() && this.j();
                    }
                    dispose() {
                        if (this.C.length > 0) {
                            const { values: t } = this.contextNode;
                            this.C.forEach((e, n) => t.unsubscribe(e, this.O[n]));
                        }
                        this.L();
                    }
                    rootUpdated() {
                        const t = this.p();
                        this.L(), t && this.j();
                    }
                    p() {
                        return !!this.contextNode.root;
                    }
                    j() {
                        this.p() && (this.I.every(kt) ? ((this.N = !0), this.D()) : this.N && ((this.N = !1), this.L()));
                    }
                    D() {
                        this.L();
                        const t = this.V;
                        this.$ = (function (t, e) {
                            switch (e.length) {
                                case 0:
                                    return t();
                                case 1:
                                    return t(e[0]);
                                case 2:
                                    return t(e[0], e[1]);
                                case 3:
                                    return t(e[0], e[1], e[2]);
                                default:
                                    return t.apply(null, e);
                            }
                        })(t, this.I);
                    }
                    L() {
                        this.$ && (Y(this.$), (this.$ = null));
                    }
                };
            function kt(t) {
                return void 0 !== t;
            }
            function xt(t) {
                ot.get(t).discover();
            }
            function $t(t, e, n, i) {
                ot.get(t).values.set(e, n, i);
            }
            function Et(t, e, n) {
                ot.get(t).values.remove(e, n);
            }
            var Ot,
                St,
                Lt,
                Tt = {},
                Pt = [],
                Mt = /acit|ex(?:s|g|n|p|$)|rph|grid|ows|mnc|ntw|ine[ch]|zoo|^ord|itera/i;
            function At(t, e) {
                for (var n in e) t[n] = e[n];
                return t;
            }
            function Ht(t) {
                var e = t.parentNode;
                e && e.removeChild(t);
            }
            function Nt(t, e, n) {
                var i,
                    o,
                    r,
                    s = {};
                for (r in e) "key" == r ? (i = e[r]) : "ref" == r ? (o = e[r]) : (s[r] = e[r]);
                if ((arguments.length > 2 && (s.children = arguments.length > 3 ? vt.call(arguments, 2) : n), "function" == typeof t && null != t.defaultProps)) for (r in t.defaultProps) void 0 === s[r] && (s[r] = t.defaultProps[r]);
                return Rt(t, s, i, o, null);
            }
            function Rt(t, e, n, i, o) {
                var r = { type: t, props: e, key: n, ref: i, __k: null, __: null, __b: 0, __e: null, __d: void 0, __c: null, __h: null, constructor: void 0, __v: null == o ? ++gt : o };
                return null == o && null != mt.vnode && mt.vnode(r), r;
            }
            function Dt(t) {
                return t.children;
            }
            function jt(t, e) {
                (this.props = t), (this.context = e);
            }
            function Wt(t, e) {
                if (null == e) return t.__ ? Wt(t.__, t.__.__k.indexOf(t) + 1) : null;
                for (var n; e < t.__k.length; e++) if (null != (n = t.__k[e]) && null != n.__e) return n.__e;
                return "function" == typeof t.type ? Wt(t) : null;
            }
            function Yt(t) {
                var e, n;
                if (null != (t = t.__) && null != t.__c) {
                    for (t.__e = t.__c.base = null, e = 0; e < t.__k.length; e++)
                        if (null != (n = t.__k[e]) && null != n.__e) {
                            t.__e = t.__c.base = n.__e;
                            break;
                        }
                    return Yt(t);
                }
            }
            function It(t) {
                ((!t.__d && (t.__d = !0) && yt.push(t) && !Xt.__r++) || bt !== mt.debounceRendering) && ((bt = mt.debounceRendering) || _t)(Xt);
            }
            function Xt() {
                for (var t; (Xt.__r = yt.length);)
                    (t = yt.sort(function (t, e) {
                        return t.__v.__b - e.__v.__b;
                    })),
                        (yt = []),
                        t.some(function (t) {
                            var e, n, i, o, r, s;
                            t.__d &&
                                ((r = (o = (e = t).__v).__e),
                                    (s = e.__P) && ((n = []), ((i = At({}, o)).__v = o.__v + 1), Zt(s, o, i, e.__n, void 0 !== s.ownerSVGElement, null != o.__h ? [r] : null, n, null == r ? Wt(o) : r, o.__h), Kt(n, o), o.__e != r && Yt(o)));
                        });
            }
            function Ft(t, e, n, i, o, r, s, l, a, c) {
                var u,
                    f,
                    h,
                    d,
                    p,
                    v,
                    m,
                    g = (i && i.__k) || Pt,
                    y = g.length;
                for (n.__k = [], u = 0; u < e.length; u++)
                    if (
                        null !=
                        (d = n.__k[u] =
                            null == (d = e[u]) || "boolean" == typeof d
                                ? null
                                : "string" == typeof d || "number" == typeof d || "bigint" == typeof d
                                    ? Rt(null, d, null, null, d)
                                    : Array.isArray(d)
                                        ? Rt(Dt, { children: d }, null, null, null)
                                        : d.__b > 0
                                            ? Rt(d.type, d.props, d.key, null, d.__v)
                                            : d)
                    ) {
                        if (((d.__ = n), (d.__b = n.__b + 1), null === (h = g[u]) || (h && d.key == h.key && d.type === h.type))) g[u] = void 0;
                        else
                            for (f = 0; f < y; f++) {
                                if ((h = g[f]) && d.key == h.key && d.type === h.type) {
                                    g[f] = void 0;
                                    break;
                                }
                                h = null;
                            }
                        Zt(t, d, (h = h || Tt), o, r, s, l, a, c),
                            (p = d.__e),
                            (f = d.ref) && h.ref != f && (m || (m = []), h.ref && m.push(h.ref, null, d), m.push(f, d.__c || p, d)),
                            null != p
                                ? (null == v && (v = p), "function" == typeof d.type && d.__k === h.__k ? (d.__d = a = Bt(d, a, t)) : (a = Vt(t, d, h, g, p, a)), "function" == typeof n.type && (n.__d = a))
                                : a && h.__e == a && a.parentNode != t && (a = Wt(h));
                    }
                for (n.__e = v, u = y; u--;) null != g[u] && ("function" == typeof n.type && null != g[u].__e && g[u].__e == n.__d && (n.__d = Wt(i, u + 1)), Qt(g[u], g[u]));
                if (m) for (u = 0; u < m.length; u++) Jt(m[u], m[++u], m[++u]);
            }
            function Bt(t, e, n) {
                for (var i, o = t.__k, r = 0; o && r < o.length; r++) (i = o[r]) && ((i.__ = t), (e = "function" == typeof i.type ? Bt(i, e, n) : Vt(n, i, i, o, i.__e, e)));
                return e;
            }
            function Vt(t, e, n, i, o, r) {
                var s, l, a;
                if (void 0 !== e.__d) (s = e.__d), (e.__d = void 0);
                else if (null == n || o != r || null == o.parentNode)
                    t: if (null == r || r.parentNode !== t) t.appendChild(o), (s = null);
                    else {
                        for (l = r, a = 0; (l = l.nextSibling) && a < i.length; a += 2) if (l == o) break t;
                        t.insertBefore(o, r), (s = r);
                    }
                return void 0 !== s ? s : o.nextSibling;
            }
            function Ut(t, e, n) {
                "-" === e[0] ? t.setProperty(e, n) : (t[e] = null == n ? "" : "number" != typeof n || Mt.test(e) ? n : n + "px");
            }
            function zt(t, e, n, i, o) {
                var r;
                t: if ("style" === e)
                    if ("string" == typeof n) t.style.cssText = n;
                    else {
                        if (("string" == typeof i && (t.style.cssText = i = ""), i)) for (e in i) (n && e in n) || Ut(t.style, e, "");
                        if (n) for (e in n) (i && n[e] === i[e]) || Ut(t.style, e, n[e]);
                    }
                else if ("o" === e[0] && "n" === e[1])
                    (r = e !== (e = e.replace(/Capture$/, ""))),
                        (e = e.toLowerCase() in t ? e.toLowerCase().slice(2) : e.slice(2)),
                        t.l || (t.l = {}),
                        (t.l[e + r] = n),
                        n ? i || t.addEventListener(e, r ? Gt : qt, r) : t.removeEventListener(e, r ? Gt : qt, r);
                else if ("dangerouslySetInnerHTML" !== e) {
                    if (o) e = e.replace(/xlink[H:h]/, "h").replace(/sName$/, "s");
                    else if ("href" !== e && "list" !== e && "form" !== e && "tabIndex" !== e && "download" !== e && e in t)
                        try {
                            t[e] = null == n ? "" : n;
                            break t;
                        } catch (t) { }
                    "function" == typeof n || (null != n && (!1 !== n || ("a" === e[0] && "r" === e[1])) ? t.setAttribute(e, n) : t.removeAttribute(e));
                }
            }
            function qt(t) {
                this.l[t.type + !1](mt.event ? mt.event(t) : t);
            }
            function Gt(t) {
                this.l[t.type + !0](mt.event ? mt.event(t) : t);
            }
            function Zt(t, e, n, i, o, r, s, l, a) {
                var c,
                    u,
                    f,
                    h,
                    d,
                    p,
                    v,
                    m,
                    g,
                    y,
                    _,
                    b = e.type;
                if (void 0 !== e.constructor) return null;
                null != n.__h && ((a = n.__h), (l = e.__e = n.__e), (e.__h = null), (r = [l])), (c = mt.__b) && c(e);
                try {
                    t: if ("function" == typeof b) {
                        if (
                            ((m = e.props),
                                (g = (c = b.contextType) && i[c.__c]),
                                (y = c ? (g ? g.props.value : c.__) : i),
                                n.__c
                                    ? (v = (u = e.__c = n.__c).__ = u.__E)
                                    : ("prototype" in b && b.prototype.render ? (e.__c = u = new b(m, y)) : ((e.__c = u = new jt(m, y)), (u.constructor = b), (u.render = te)),
                                        g && g.sub(u),
                                        (u.props = m),
                                        u.state || (u.state = {}),
                                        (u.context = y),
                                        (u.__n = i),
                                        (f = u.__d = !0),
                                        (u.__h = [])),
                                null == u.__s && (u.__s = u.state),
                                null != b.getDerivedStateFromProps && (u.__s == u.state && (u.__s = At({}, u.__s)), At(u.__s, b.getDerivedStateFromProps(m, u.__s))),
                                (h = u.props),
                                (d = u.state),
                                f)
                        )
                            null == b.getDerivedStateFromProps && null != u.componentWillMount && u.componentWillMount(), null != u.componentDidMount && u.__h.push(u.componentDidMount);
                        else {
                            if (
                                (null == b.getDerivedStateFromProps && m !== h && null != u.componentWillReceiveProps && u.componentWillReceiveProps(m, y),
                                    (!u.__e && null != u.shouldComponentUpdate && !1 === u.shouldComponentUpdate(m, u.__s, y)) || e.__v === n.__v)
                            ) {
                                (u.props = m),
                                    (u.state = u.__s),
                                    e.__v !== n.__v && (u.__d = !1),
                                    (u.__v = e),
                                    (e.__e = n.__e),
                                    (e.__k = n.__k),
                                    e.__k.forEach(function (t) {
                                        t && (t.__ = e);
                                    }),
                                    u.__h.length && s.push(u);
                                break t;
                            }
                            null != u.componentWillUpdate && u.componentWillUpdate(m, u.__s, y),
                                null != u.componentDidUpdate &&
                                u.__h.push(function () {
                                    u.componentDidUpdate(h, d, p);
                                });
                        }
                        (u.context = y),
                            (u.props = m),
                            (u.state = u.__s),
                            (c = mt.__r) && c(e),
                            (u.__d = !1),
                            (u.__v = e),
                            (u.__P = t),
                            (c = u.render(u.props, u.state, u.context)),
                            (u.state = u.__s),
                            null != u.getChildContext && (i = At(At({}, i), u.getChildContext())),
                            f || null == u.getSnapshotBeforeUpdate || (p = u.getSnapshotBeforeUpdate(h, d)),
                            (_ = null != c && c.type === Dt && null == c.key ? c.props.children : c),
                            Ft(t, Array.isArray(_) ? _ : [_], e, n, i, o, r, s, l, a),
                            (u.base = e.__e),
                            (e.__h = null),
                            u.__h.length && s.push(u),
                            v && (u.__E = u.__ = null),
                            (u.__e = !1);
                    } else
                        null == r && e.__v === n.__v
                            ? ((e.__k = n.__k), (e.__e = n.__e))
                            : (e.__e = (function (t, e, n, i, o, r, s, l) {
                                var a,
                                    c,
                                    u,
                                    f = n.props,
                                    h = e.props,
                                    d = e.type,
                                    p = 0;
                                if (("svg" === d && (o = !0), null != r))
                                    for (; p < r.length; p++)
                                        if ((a = r[p]) && (a === t || (d ? a.localName == d : 3 == a.nodeType))) {
                                            (t = a), (r[p] = null);
                                            break;
                                        }
                                if (null == t) {
                                    if (null === d) return document.createTextNode(h);
                                    (t = o ? document.createElementNS("http://www.w3.org/2000/svg", d) : document.createElement(d, h.is && h)), (r = null), (l = !1);
                                }
                                if (null === d) f === h || (l && t.data === h) || (t.data = h);
                                else {
                                    if (((r = r && vt.call(t.childNodes)), (c = (f = n.props || Tt).dangerouslySetInnerHTML), (u = h.dangerouslySetInnerHTML), !l)) {
                                        if (null != r) for (f = {}, p = 0; p < t.attributes.length; p++) f[t.attributes[p].name] = t.attributes[p].value;
                                        (u || c) && ((u && ((c && u.__html == c.__html) || u.__html === t.innerHTML)) || (t.innerHTML = (u && u.__html) || ""));
                                    }
                                    if (
                                        ((function (t, e, n, i, o) {
                                            var r;
                                            for (r in n) "children" === r || "key" === r || r in e || zt(t, r, null, n[r], i);
                                            for (r in e) (o && "function" != typeof e[r]) || "children" === r || "key" === r || "value" === r || "checked" === r || n[r] === e[r] || zt(t, r, e[r], n[r], i);
                                        })(t, h, f, o, l),
                                            u)
                                    )
                                        e.__k = [];
                                    else if (((p = e.props.children), Ft(t, Array.isArray(p) ? p : [p], e, n, i, o && "foreignObject" !== d, r, s, r ? r[0] : n.__k && Wt(n, 0), l), null != r))
                                        for (p = r.length; p--;) null != r[p] && Ht(r[p]);
                                    l ||
                                        ("value" in h && void 0 !== (p = h.value) && (p !== t.value || ("progress" === d && !p)) && zt(t, "value", p, f.value, !1),
                                            "checked" in h && void 0 !== (p = h.checked) && p !== t.checked && zt(t, "checked", p, f.checked, !1));
                                }
                                return t;
                            })(n.__e, e, n, i, o, r, s, a));
                    (c = mt.diffed) && c(e);
                } catch (t) {
                    (e.__v = null), (a || null != r) && ((e.__e = l), (e.__h = !!a), (r[r.indexOf(l)] = null)), mt.__e(t, e, n);
                }
            }
            function Kt(t, e) {
                mt.__c && mt.__c(e, t),
                    t.some(function (e) {
                        try {
                            (t = e.__h),
                                (e.__h = []),
                                t.some(function (t) {
                                    t.call(e);
                                });
                        } catch (t) {
                            mt.__e(t, e.__v);
                        }
                    });
            }
            function Jt(t, e, n) {
                try {
                    "function" == typeof t ? t(e) : (t.current = e);
                } catch (t) {
                    mt.__e(t, n);
                }
            }
            function Qt(t, e, n) {
                var i, o;
                if ((mt.unmount && mt.unmount(t), (i = t.ref) && ((i.current && i.current !== t.__e) || Jt(i, null, e)), null != (i = t.__c))) {
                    if (i.componentWillUnmount)
                        try {
                            i.componentWillUnmount();
                        } catch (t) {
                            mt.__e(t, e);
                        }
                    i.base = i.__P = null;
                }
                if ((i = t.__k)) for (o = 0; o < i.length; o++) i[o] && Qt(i[o], e, "function" != typeof t.type);
                n || null == t.__e || Ht(t.__e), (t.__e = t.__d = void 0);
            }
            function te(t, e, n) {
                return this.constructor(t, n);
            }
            function ee(t, e, n) {
                var i, o, r;
                mt.__ && mt.__(t, e),
                    (o = (i = "function" == typeof n) ? null : (n && n.__k) || e.__k),
                    (r = []),
                    Zt(e, (t = ((!i && n) || e).__k = Nt(Dt, null, [t])), o || Tt, Tt, void 0 !== e.ownerSVGElement, !i && n ? [n] : o ? null : e.firstChild ? vt.call(e.childNodes) : null, r, !i && n ? n : o ? o.__e : e.firstChild, i),
                    Kt(r, t);
            }
            function ne(t, e) {
                ee(t, e, ne);
            }
            (vt = Pt.slice),
                (mt = {
                    __e: function (t, e) {
                        for (var n, i, o; (e = e.__);)
                            if ((n = e.__c) && !n.__)
                                try {
                                    if (((i = n.constructor) && null != i.getDerivedStateFromError && (n.setState(i.getDerivedStateFromError(t)), (o = n.__d)), null != n.componentDidCatch && (n.componentDidCatch(t), (o = n.__d)), o))
                                        return (n.__E = n);
                                } catch (e) {
                                    t = e;
                                }
                        throw t;
                    },
                }),
                (gt = 0),
                (jt.prototype.setState = function (t, e) {
                    var n;
                    (n = null != this.__s && this.__s !== this.state ? this.__s : (this.__s = At({}, this.state))),
                        "function" == typeof t && (t = t(At({}, n), this.props)),
                        t && At(n, t),
                        null != t && this.__v && (e && this.__h.push(e), It(this));
                }),
                (jt.prototype.forceUpdate = function (t) {
                    this.__v && ((this.__e = !0), t && this.__h.push(t), It(this));
                }),
                (jt.prototype.render = Dt),
                (yt = []),
                (_t = "function" == typeof Promise ? Promise.prototype.then.bind(N()) : setTimeout),
                (Xt.__r = 0),
                (wt = 0);
            var ie = 0,
                oe = [],
                re = mt.__b,
                se = mt.__r,
                le = mt.diffed,
                ae = mt.__c,
                ce = mt.unmount;
            function ue(t, e) {
                mt.__h && mt.__h(St, t, ie || e), (ie = 0);
                var n = St.__H || (St.__H = { __: [], __h: [] });
                return t >= n.__.length && n.__.push({}), n.__[t];
            }
            function fe(t, e) {
                var n = ue(Ot++, 4);
                !mt.__s && ge(n.__H, e) && ((n.__ = t), (n.__H = e), St.__h.push(n));
            }
            function he(t, e) {
                var n = ue(Ot++, 7);
                return ge(n.__H, e) && ((n.__ = t()), (n.__H = e), (n.__h = t)), n.__;
            }
            function de() {
                oe.forEach(function (t) {
                    if (t.__P)
                        try {
                            t.__H.__h.forEach(ve), t.__H.__h.forEach(me), (t.__H.__h = []);
                        } catch (e) {
                            (t.__H.__h = []), mt.__e(e, t.__v);
                        }
                }),
                    (oe = []);
            }
            (mt.__b = function (t) {
                (St = null), re && re(t);
            }),
                (mt.__r = function (t) {
                    se && se(t), (Ot = 0);
                    var e = (St = t.__c).__H;
                    e && (e.__h.forEach(ve), e.__h.forEach(me), (e.__h = []));
                }),
                (mt.diffed = function (t) {
                    le && le(t);
                    var e = t.__c;
                    e &&
                        e.__H &&
                        e.__H.__h.length &&
                        ((1 !== oe.push(e) && Lt === mt.requestAnimationFrame) ||
                            (
                                (Lt = mt.requestAnimationFrame) ||
                                function (t) {
                                    var e,
                                        n = function () {
                                            clearTimeout(i), pe && cancelAnimationFrame(e), setTimeout(t);
                                        },
                                        i = setTimeout(n, 100);
                                    pe && (e = requestAnimationFrame(n));
                                }
                            )(de)),
                        (St = null);
                }),
                (mt.__c = function (t, e) {
                    e.some(function (t) {
                        try {
                            t.__h.forEach(ve),
                                (t.__h = t.__h.filter(function (t) {
                                    return !t.__ || me(t);
                                }));
                        } catch (n) {
                            e.some(function (t) {
                                t.__h && (t.__h = []);
                            }),
                                (e = []),
                                mt.__e(n, t.__v);
                        }
                    }),
                        ae && ae(t, e);
                }),
                (mt.unmount = function (t) {
                    ce && ce(t);
                    var e = t.__c;
                    if (e && e.__H)
                        try {
                            e.__H.__.forEach(ve);
                        } catch (t) {
                            mt.__e(t, e.__v);
                        }
                });
            var pe = "function" == typeof requestAnimationFrame;
            function ve(t) {
                var e = St;
                "function" == typeof t.__c && t.__c(), (St = e);
            }
            function me(t) {
                var e = St;
                (t.__c = t.__()), (St = e);
            }
            function ge(t, e) {
                return (
                    !t ||
                    t.length !== e.length ||
                    e.some(function (e, n) {
                        return e !== t[n];
                    })
                );
            }
            var ye = ["auto", "lazy", "eager", "unload"],
                _e = { auto: 0, lazy: 1, eager: 2, unload: 3 };
            function be(t, e) {
                const n = _e[null != t ? t : "auto"] || 0,
                    i = _e[null != e ? e : "auto"] || 0,
                    o = Math.max(n, i);
                return ye[o];
            }
            function we(t) {
                return (t.ownerDocument || t).defaultView;
            }
            function Ce(t) {
                q(/^[\w-]+$/.test(t));
            }
            function ke(t, e) {
                return t.querySelector(
                    (function (t, e) {
                        return t.replace(/^|,/g, "$&:scope ");
                    })(e)
                );
            }
            function xe(t, e) {
                return t.matches(e);
            }
            function $e(t, e) {
                return Ce(e), ke(t, `> [${e}]`);
            }
            function Ee(t) {
                return (function (t, e) {
                    const n = [];
                    for (let e = t.firstChild; e; e = e.nextSibling) !Oe(e) && n.push(e);
                    return n;
                })(t);
            }
            function Oe(t) {
                return (
                    !!(function (t) {
                        let e;
                        return "string" == typeof t ? (e = t) : z(t) && (e = t.tagName), !!e && e.toLowerCase().startsWith("i-");
                    })(t) ||
                    (t.nodeType === Node.ELEMENT_NODE && (t.hasAttribute("placeholder") || t.hasAttribute("fallback") || t.hasAttribute("overflow")))
                );
            }
            var Se = { bubbles: !0, cancelable: !0 };
            function Le(t, e, n) {
                return (function (t, e) {
                    for (const n in e) t.setAttribute(n, e[n]);
                    return t;
                })(t.createElement(e), n);
            }
            function Te(t, e, n, i) {
                const o = n || {};
                q(t.ownerDocument);
                const r = t.ownerDocument.createEvent("Event");
                r.data = o;
                const { bubbles: s, cancelable: l } = i || Se;
                r.initEvent(e, s, l), t.dispatchEvent(r);
            }
            function Pe(t, e) {
                return [
                    { query: t.matchMedia(e), value: "1" },
                    { query: null, value: "" },
                ];
            }
            function Me(t, e) {
                return e
                    .split(",")
                    .map((e) => {
                        if (0 == (e = e.replace(/\s+/g, " ").trim()).length) return;
                        let n, i, o;
                        if (")" == e.charAt(e.length - 1)) {
                            let t = 1;
                            for (o = e.length - 2; o >= 0; o--) {
                                const n = e.charAt(o);
                                if (("(" == n ? t-- : ")" == n && t++, 0 == t)) break;
                            }
                            const n = o - 1;
                            if (o > 0)
                                for (o--; o >= 0; o--) {
                                    const t = e.charAt(o);
                                    if (!("%" == t || "-" == t || "_" == t || (t >= "a" && t <= "z") || (t >= "A" && t <= "Z") || (t >= "0" && t <= "9"))) break;
                                }
                            if (o >= n) return null;
                        } else
                            for (o = e.length - 2; o >= 0; o--) {
                                const t = e.charAt(o);
                                if (!("%" == t || "." == t || (t >= "a" && t <= "z") || (t >= "A" && t <= "Z") || (t >= "0" && t <= "9"))) break;
                            }
                        return o >= 0 ? ((n = e.substring(0, o + 1).trim()), (i = e.substring(o + 1).trim())) : ((i = e), (n = void 0)), i ? { query: n ? t.matchMedia(n) : null, value: i } : null;
                    })
                    .filter(Boolean);
            }
            function Ae(t, e, n) {
                for (let i = 0; i < t.length; i++) {
                    const { query: o } = t[i];
                    o && (void 0 !== o.onchange ? (o.onchange = n ? e : null) : n ? o.addListener(e) : o.removeListener(e));
                }
            }
            var He,
                Ne,
                Re,
                De,
                je = { getPropertyPriority: () => "", getPropertyValue: () => "" },
                We = /vertical/,
                Ye = new WeakMap(),
                Ie = new WeakMap(),
                Xe = new WeakMap();
            function Fe(t) {
                let e = Ye.get(t);
                return e || ((e = new t.ResizeObserver(Be)), Ye.set(t, e)), e;
            }
            function Be(t) {
                const e = new Set();
                for (let n = t.length - 1; n >= 0; n--) {
                    const i = t[n],
                        { target: o } = i;
                    if (e.has(o)) continue;
                    e.add(o);
                    const r = Ie.get(o);
                    if (r) {
                        Xe.set(o, i);
                        for (let t = 0; t < r.length; t++) {
                            const { callback: e, type: n } = r[t];
                            Ve(n, e, i);
                        }
                    }
                }
            }
            function Ve(t, e, n) {
                if (0 == t) {
                    const { contentRect: t } = n,
                        { height: i, width: o } = t;
                    Y(e, { width: o, height: i });
                } else if (1 == t) {
                    const { borderBoxSize: t } = n;
                    let i;
                    if (t) i = t.length > 0 ? t[0] : { inlineSize: 0, blockSize: 0 };
                    else {
                        const { target: t } = n,
                            e = we(t),
                            o = We.test(
                                (function (t, e) {
                                    return t.getComputedStyle(e) || je;
                                })(e, t).writingMode
                            ),
                            { offsetHeight: r, offsetWidth: s } = t;
                        let l, a;
                        o ? ((a = s), (l = r)) : ((l = s), (a = r)), (i = { inlineSize: l, blockSize: a });
                    }
                    Y(e, i);
                }
            }
            if ("undefined" != typeof AMP && AMP.BaseElement) He = AMP.BaseElement;
            else {
                class t {
                    constructor(t) {
                        (this.element = t), (this.win = we(t));
                    }
                    mutateElement(t) {
                        N().then(t);
                    }
                    isLayoutSupported() {
                        return !0;
                    }
                    mountCallback() { }
                    unmountCallback() { }
                    buildCallback() { }
                }
                He = t;
            }
            function Ue() {
                return (
                    De ||
                    (De = (function (t, e) {
                        var n = {
                            __c: (e = "__cC" + wt++),
                            __: { renderable: !0, playable: !0, loading: "auto" },
                            Consumer: function (t, e) {
                                return t.children(e);
                            },
                            Provider: function (t) {
                                var n, i;
                                return (
                                    this.getChildContext ||
                                    ((n = []),
                                        ((i = {})[e] = this),
                                        (this.getChildContext = function () {
                                            return i;
                                        }),
                                        (this.shouldComponentUpdate = function (t) {
                                            this.props.value !== t.value && n.some(It);
                                        }),
                                        (this.sub = function (t) {
                                            n.push(t);
                                            var e = t.componentWillUnmount;
                                            t.componentWillUnmount = function () {
                                                n.splice(n.indexOf(t), 1), e && e.call(t);
                                            };
                                        })),
                                    t.children
                                );
                            },
                        };
                        return (n.Provider.__ = n.Consumer.contextType = n);
                    })())
                );
            }
            function ze({ children: t, loading: e = "auto", notify: n, playable: i = !0, renderable: o = !0 }) {
                const r = qe(),
                    s = o && r.renderable,
                    l = s && i && r.playable,
                    a = be(s ? "auto" : "lazy", be(e, r.loading)),
                    c = n || r.notify,
                    u = he(() => ({ renderable: s, playable: l, loading: a, notify: c }), [s, l, a, c]);
                return Nt(Ue().Provider, { children: t, value: u });
            }
            function qe() {
                return (function (t) {
                    var e = St.context[t.__c],
                        n = ue(Ot++, 9);
                    return (n.c = t), e ? (null == n.__ && ((n.__ = !0), e.sub(St)), e.props.value) : t.__;
                })(Ue());
            }
            var Ge = ft("CanRender", { defaultValue: !0, recursive: (t) => t.reduce(Je), compute: (t, e, n) => (n && e.reduce(Je, !0)) || !1 }),
                Ze = ft("CanPlay", { defaultValue: !0, recursive: (t) => t.reduce(Je), deps: [Ge], compute: (t, e, n, i) => (i && n && e.reduce(Je, !0)) || !1 }),
                Ke = ft("Loading", { defaultValue: "auto", recursive: !0, deps: [Ge], compute: (t, e, n, i) => be(i ? "auto" : "lazy", be(n || "auto", e.reduce(be, "auto"))) }),
                Je = (t, e) => t && e,
                Qe = (t) => t.ensureLoaded(),
                tn = (t) => t.pause(),
                en = (t) => t.unmount();
            function nn(t, e = !0) {
                sn(t, e, !1, Qe);
            }
            function on(t, e = !0) {
                sn(t, e, !0, tn);
            }
            function rn(t, e = !0) {
                sn(t, e, !0, en);
            }
            function sn(t, e, n, i) {
                const o = B(t);
                for (let t = 0; t < o.length; t++) ln(o[t], e, n, i);
            }
            function ln(t, e, n, i) {
                if (e && t.classList.contains("i-amphtml-element")) {
                    const e = t;
                    if ((Y(i, e), !n)) {
                        const t = e.getPlaceholder();
                        return void (t && ln(t, !0, !1, i));
                    }
                }
                const o = t.getElementsByClassName("i-amphtml-element");
                let r = null;
                for (let t = 0; t < o.length; t++) {
                    const e = o[t];
                    if (n) Y(i, e);
                    else {
                        r = r || [];
                        let t = !1;
                        for (let n = 0; n < r.length; n++)
                            if (r[n].contains(e)) {
                                t = !0;
                                break;
                            }
                        t || (r.push(e), Y(i, e));
                    }
                }
            }
            var an = {},
                cn = new WeakMap();
            function un(t, e, n, i = !1) {
                if ((t.setAttribute("slot", e), !i)) return Nt(fn, ct(ct({}, n || an), {}, { name: e }));
                const o = cn.get(t);
                if (
                    o &&
                    (function (t, e) {
                        if (null == t || null == e) return t === e;
                        for (const n in t) if (t[n] !== e[n]) return !1;
                        for (const n in e) if (e[n] !== t[n]) return !1;
                        return !0;
                    })(o.oldProps, n)
                )
                    return o.component;
                function r(t) {
                    return Nt(fn, ct(ct({}, n || an), {}, { name: e }, t));
                }
                return cn.set(t, { oldProps: n, component: r }), r;
            }
            function fn(t) {
                const e = (function (t) {
                    return (
                        (ie = 5),
                        he(function () {
                            return { current: t };
                        }, [])
                    );
                })(null);
                return (
                    (function (t, e) {
                        const n = null == e ? void 0 : e.loading,
                            i = qe();
                        fe(() => {
                            const e = t.current;
                            return (
                                q(z(e)),
                                $t(e, Ge, fn, i.renderable),
                                $t(e, Ze, fn, i.playable),
                                $t(e, Ke, fn, i.loading),
                                i.playable || hn(e, on, !0),
                                () => {
                                    Et(e, Ge, fn),
                                        Et(e, Ze, fn),
                                        Et(e, Ke, fn),
                                        (function (t) {
                                            ot.rediscoverChildren(t);
                                        })(e);
                                }
                            );
                        }, [t, i]),
                            fe(() => {
                                const e = t.current;
                                return (
                                    q(z(e)),
                                    "lazy" != n && hn(e, nn, !0),
                                    () => {
                                        hn(e, rn, !1);
                                    }
                                );
                            }, [t, n]);
                    })(e, t),
                    (function (t, e) {
                        var n = ue(Ot++, 3);
                        !mt.__s && ge(n.__H, e) && ((n.__ = t), (n.__H = e), St.__H.__h.push(n));
                    })(() => {
                        t.postRender && t.postRender();
                    }),
                    Nt("slot", ct(ct({}, t), {}, { ref: e }))
                );
            }
            function hn(t, e, n) {
                const i = t.assignedElements ? t.assignedElements() : t;
                if (Array.isArray(i) && 0 == i.length) return;
                if (!n) return void e(i);
                const o = t.ownerDocument.defaultView;
                o && (o.requestIdleCallback || o.setTimeout)(() => e(i));
            }
            var dn = { position: "absolute", top: "0", left: "0", width: "100%", height: "100%" },
                pn = (function () {
                    let t = 0;
                    return () => String(++t);
                })();
            function vn(t, e) {
                return Object.values(t).some(e);
            }
            var mn = (t) => "string" == typeof t || !!t.selector,
                gn = (t) => {
                    var e;
                    return 3 === t.nodeType && 0 === (null === (e = t.nodeValue) || void 0 === e ? void 0 : e.trim().length);
                };
            function yn(t, e, n, i, o) {
                const { layoutSizeDefined: r, lightDomTag: s, props: l } = t;
                o && o.start();
                const a = ct(ct({}, i), {}, { ref: n });
                return s && ((a["i-amphtml-rendered"] = !0), (a.__AMP_RENDERED = !0), (a.as = s)), r && (t.usesShadowDom ? (a.style = dn) : (a.class = "i-amphtml-fill-content")), _n(t, a, l, e, o), o && o.complete(), a;
            }
            function _n(t, e, n, i, o) {
                if (vn(n, mn)) {
                    const r = (function (t) {
                        return (function (t, e) {
                            const n = [];
                            for (let e = t.firstElementChild; e; e = e.nextElementSibling) !Oe(e) && n.push(e);
                            return n;
                        })(t);
                    })(i);
                    for (let i = 0; i < r.length; i++) {
                        const s = r[i],
                            l = wn(s, n);
                        if (!l) continue;
                        const a = n[l],
                            { as: c = !1, single: u, name: f = l, clone: h, props: d = {} } = a;
                        q(h || t.usesShadowDom);
                        const p = {};
                        if ((_n(t, p, d, s, o), u)) e[f] = un(s, s.getAttribute("slot") || `i-amphtml-${f}`, p, c);
                        else {
                            const t = e[f] || (e[f] = []);
                            q(!c), t.push(h ? bn(s) : un(s, s.getAttribute("slot") || `i-amphtml-${f}-${pn()}`, p));
                        }
                    }
                }
                for (const s in n) {
                    const l = n[s];
                    let a;
                    if ((q([l.attr, l.attrs, l.attrMatches, l.selector, l.passthrough, l.passthroughNonEmpty].filter(Boolean).length <= 1), l.passthrough)) q(t.usesShadowDom), (a = [Nt(fn, { loading: "lazy" })]);
                    else if (l.passthroughNonEmpty) q(t.usesShadowDom), (a = Ee(i).every(gn) ? null : [Nt(fn, { loading: "lazy" })]);
                    else if (l.attr) {
                        const t = i.getAttribute(l.attr);
                        (a = t && l.parseAttr ? l.parseAttr(t) : t), l.media && null != a && (q(o), (a = o.resolveListQuery(String(a))));
                    } else l.parseAttrs && (q(l.attrs || l.attrMatches), (a = l.parseAttrs(i)));
                    if (null == a) null != l.default && (e[s] = l.default);
                    else {
                        const t = "number" == l.type ? parseFloat(a) : "boolean" == l.type ? (null == (r = a) ? void 0 : "false" !== r) : a;
                        e[s] = t;
                    }
                }
                var r;
            }
            function bn(t) {
                const e = { key: t },
                    { attributes: n, localName: i } = t,
                    { length: o } = n;
                for (let t = 0; t < o; t++) {
                    const { name: i, value: o } = n[t];
                    e[i] = o;
                }
                return Nt(i, e);
            }
            function wn(t, e) {
                for (const n in e) {
                    const i = e[n],
                        o = "string" == typeof i ? i : i.selector;
                    if (o && xe(t, o)) return n;
                }
                return null;
            }
            var Cn = { childList: !0 },
                kn = { childList: !0, characterData: !0 },
                xn = { childList: !0 },
                $n = { style: "display: contents; background: inherit;", part: "c" },
                En = { name: "i-amphtml-svc" },
                On = { "i-amphtml-rendered": "" },
                Sn = () => !0,
                Ln = (t) => !!t.media,
                Tn = (t) => !(!t.passthrough && !t.passthroughNonEmpty),
                Pn = class extends He {
                    static R1() {
                        return !0;
                    }
                    static requiresShadowDom() {
                        return this.usesShadowDom;
                    }
                    static usesLoading() {
                        return this.loadable;
                    }
                    static prerenderAllowed() {
                        return !this.usesLoading();
                    }
                    static previewAllowed() {
                        return !1;
                    }
                    static Component() {
                        q(!1);
                    }
                    getDefaultProps() {
                        return {
                            loading: "auto",
                            onReadyState: (t, e) => {
                                this.U(t, e);
                            },
                            onPlayingState: (t) => {
                                this.q(t);
                            },
                        };
                    }
                    constructor(t) {
                        super(t),
                            (this.W = this.getDefaultProps()),
                            (this.F = { renderable: !1, playable: !0, loading: "auto", notify: () => this.mutateElement(() => { }) }),
                            (this.B = !1),
                            (this.H = null),
                            (this.G = null),
                            (this.Z = (t) => {
                                null !== t && (this.H ? this.J(t) : this.K(t)), (this.G = t), this.X();
                            }),
                            (this.Y = null),
                            (this.tt = null),
                            (this.nt = null),
                            (this.it = !1),
                            (this.et = null),
                            (this.rt = () => {
                                (this.it = !1), this.st();
                            }),
                            (this.ot = !1),
                            (this.ut = !1),
                            (this.observer = null),
                            (this.lt = new (class {
                                constructor(t) {
                                    (this.ct = t), (this.ft = !1), (this.ht = !1), (this.dt = this.dt.bind(this));
                                }
                                updatePlaying(t) {
                                    t !== this.ft &&
                                        ((this.ft = t),
                                            t
                                                ? ((this.ht = !1),
                                                    (function (t, e) {
                                                        !(function (t, e, n) {
                                                            const i = t.ownerDocument.defaultView;
                                                            if (!i) return;
                                                            let o = Ie.get(t);
                                                            if ((o || ((o = []), Ie.set(t, o), Fe(i).observe(t)), !o.some((t) => t.callback === n && 1 === t.type))) {
                                                                o.push({ type: 1, callback: n });
                                                                const e = Xe.get(t);
                                                                e && setTimeout(() => Ve(1, n, e));
                                                            }
                                                        })(t, 0, e);
                                                    })(this.ct, this.dt))
                                                : (function (t, e) {
                                                    !(function (t, e, n) {
                                                        const i = Ie.get(t);
                                                        if (
                                                            i &&
                                                            ((function (t, e) {
                                                                const i = [];
                                                                let o = 0;
                                                                for (let e = 0; e < t.length; e++) {
                                                                    const s = t[e];
                                                                    (r = s).callback === n && 1 === r.type ? i.push(s) : (o < e && (t[o] = s), o++);
                                                                }
                                                                var r;
                                                                o < t.length && (t.length = o);
                                                            })(i),
                                                                0 == i.length)
                                                        ) {
                                                            Ie.delete(t), Xe.delete(t);
                                                            const e = t.ownerDocument.defaultView;
                                                            e && Fe(e).unobserve(t);
                                                        }
                                                    })(t, 0, e);
                                                })(this.ct, this.dt));
                                }
                                dt({ blockSize: t, inlineSize: e }) {
                                    const n = e > 0 && t > 0;
                                    if (n === this.ht) return;
                                    this.ht = n;
                                    const i = this.ct;
                                    n || i.pause();
                                }
                            })(t)),
                            (this.vt = null);
                    }
                    init() { }
                    isLayoutSupported(t) {
                        return this.constructor.layoutSizeDefined
                            ? (function (t) {
                                return "fixed" == t || "fixed-height" == t || "responsive" == t || "fill" == t || "flex-item" == t || "fluid" == t || "intrinsic" == t;
                            })(t) || "container" == t
                            : super.isLayoutSupported(t);
                    }
                    buildCallback() {
                        const t = this.constructor;
                        this.observer = new MutationObserver((t) => this.yt(t));
                        const { props: e } = t,
                            n = vn(e, mn) ? Cn : null,
                            i = vn(e, Tn) ? kn : null,
                            o = t.usesTemplate ? xn : null;
                        this.observer.observe(this.element, ct(ct(ct({ attributes: !0 }, n), i), o)),
                            (this.vt = vn(e, Ln)
                                ? new (class {
                                    constructor(t, e) {
                                        (this.bt = t), (this._t = e), (this.gt = {}), (this.Pt = null);
                                    }
                                    start() {
                                        (this.Pt = this.gt), (this.gt = {});
                                    }
                                    resolveMatchQuery(t) {
                                        return "1" === this.At(t, Pe, "1");
                                    }
                                    resolveListQuery(t) {
                                        return this.At(t, Me, "");
                                    }
                                    complete() {
                                        for (const t in this.Pt) t in this.gt || Ae(this.Pt[t], this._t, !1);
                                        this.Pt = null;
                                    }
                                    dispose() {
                                        for (const t in this.gt) Ae(this.gt[t], this._t, !1);
                                        this.gt = {};
                                    }
                                    At(t, e, n) {
                                        if (!t.trim()) return n;
                                        let i = this.gt[t];
                                        return (
                                            i || (q(this.Pt), (i = this.Pt[t])),
                                            i || ((i = e(this.bt, t)), Ae(i, this._t, !0)),
                                            (this.gt[t] = i),
                                            (function (t) {
                                                for (let e = 0; e < t.length; e++) {
                                                    const { query: n, value: i } = t[e];
                                                    if (!n || n.matches) return i;
                                                }
                                                return "";
                                            })(i)
                                        );
                                    }
                                })(this.win, () => this.wt())
                                : null);
                        const { staticProps: r } = t,
                            s = this.init();
                        Object.assign(this.W, r, s),
                            this.checkPropsPostMutations(),
                            pt(this.element, [], () => () => {
                                (this.ut = !1), this.nt && ee(null, this.nt);
                            }),
                            pt(this.element, [Ge, Ze, Ke], (t, e, n) => {
                                (this.F.renderable = t), (this.F.playable = e), (this.F.loading = n), (this.ut = !0), this.wt();
                            });
                        const { useContexts: l } = t;
                        var a;
                        return (
                            0 != l.length &&
                            pt(this.element, l, (...t) => {
                                (this.tt = t), this.wt();
                            }),
                            (this.et = new R()),
                            this.wt(),
                            t.loadable && (null === (a = this.setReadyState) || void 0 === a || a.call(this, "loading")),
                            this.X(),
                            this.et.promise
                        );
                    }
                    ensureLoaded() {
                        this.constructor.loadable && (this.mutateProps({ loading: "eager" }), (this.B = !0));
                    }
                    mountCallback() {
                        xt(this.element), this.constructor.loadable && "auto" != this.getProp("loading") && (this.mutateProps({ loading: "auto" }), (this.B = !1));
                    }
                    unmountCallback() {
                        var t;
                        xt(this.element), this.constructor.loadable && this.mutateProps({ loading: "unload" }), this.q(!1), null === (t = this.vt) || void 0 === t || t.dispose();
                    }
                    mutateProps(t) {
                        Object.assign(this.W, t), this.wt();
                    }
                    api() {
                        const t = this.G;
                        return q(t), t;
                    }
                    mutationObserverCallback(t) { }
                    checkPropsPostMutations() { }
                    updatePropsForRendering(t) { }
                    isReady(t) {
                        return !0;
                    }
                    yt(t) {
                        const e = this.constructor;
                        this.mutationObserverCallback(t);
                        const n = t.some((t) =>
                            (function (t, e) {
                                const { type: n } = e;
                                if ("attributes" == n) {
                                    if (t.usesTemplate && "template" == e.attributeName) return !0;
                                    const { props: n } = t;
                                    for (const t in n) {
                                        var i, o;
                                        const r = n[t],
                                            s = e.attributeName;
                                        if ((q(s), s == r.attr || (null !== (i = r.attrs) && void 0 !== i && i.includes(s)) || (null !== (o = r.attrMatches) && void 0 !== o && o.call(r, s)))) return !0;
                                    }
                                    return !1;
                                }
                                return "childList" == n && (Mn(e.addedNodes) || Mn(e.removedNodes));
                            })(e, t)
                        );
                        n && (this.checkPropsPostMutations(), this.wt());
                    }
                    wt() {
                        this.it || ((this.it = !0), this.mutateElement(this.rt));
                    }
                    X() {
                        const { G: t } = this,
                            e = null == t ? void 0 : t.readyState;
                        e && e !== this.element.readyState && this.U(e);
                    }
                    U(t, e) {
                        var n;
                        null === (n = this.setReadyState) || void 0 === n || n.call(this, t, e), this.constructor.unloadOnPause && this.q("complete" == t), this.B && ((this.B = !1), this.mutateProps({ loading: "auto" }));
                    }
                    st() {
                        if (!this.ut) return;
                        const t = this.constructor,
                            { detached: e, usesShadowDom: n } = t,
                            i = n ? null : t.lightDomTag;
                        if (!this.nt) {
                            const f = this.win.document;
                            if (n) {
                                q(!e);
                                let { shadowRoot: n } = this.element,
                                    i = n && ((u = n), Ce("c"), ke(u, "> c"));
                                if (i) this.ot = !0;
                                else {
                                    var o, r, s, l, a, c;
                                    n = this.element.attachShadow({ mode: "open", delegatesFocus: t.delegatesFocus });
                                    const { shadowCss: e } = t;
                                    e &&
                                        (function (t, e, n) {
                                            const i = t.ownerDocument,
                                                o = i.defaultView;
                                            if (void 0 !== t.adoptedStyleSheets && void 0 !== o.CSSStyleSheet.prototype.replaceSync) {
                                                const i = o.__AMP_SHADOW_CSS || (o.__AMP_SHADOW_CSS = {});
                                                let r = i[e];
                                                r || ((r = new o.CSSStyleSheet()), q(r.replaceSync), r.replaceSync(n), (i[e] = r)), (t.adoptedStyleSheets = t.adoptedStyleSheets.concat(r));
                                            } else {
                                                const o = i.createElement("style");
                                                o.setAttribute("data-name", e), (o.textContent = n), t.appendChild(o);
                                            }
                                        })(n, this.element.tagName, e),
                                        (i = Le(f, "c", $n)),
                                        n.appendChild(i);
                                    const u = Le(f, "slot", En);
                                    n.appendChild(u),
                                        null === (o = this.getPlaceholder) || void 0 === o || null === (r = o.call(this)) || void 0 === r || r.setAttribute("slot", "i-amphtml-svc"),
                                        null === (s = this.getFallback) || void 0 === s || null === (l = s.call(this)) || void 0 === l || l.setAttribute("slot", "i-amphtml-svc"),
                                        null === (a = this.getOverflowElement) || void 0 === a || null === (c = a.call(this)) || void 0 === c || c.setAttribute("slot", "i-amphtml-svc");
                                }
                                (this.nt = i),
                                    q(n),
                                    (function (t, e) {
                                        ot.get(t).setParent(e);
                                    })(n, this.element),
                                    (function (t, e, n, i = 0) {
                                        ot.get(t).addGroup(e, n, i);
                                    })(this.element, "unslotted", Sn, -1),
                                    (function (t, e, n, i, o) {
                                        var r;
                                        null === (r = ot.get(t).group("unslotted")) || void 0 === r || r.values.set(n, i, !1);
                                    })(this.element, 0, Ge, this);
                            } else if (i) {
                                const e = this.element;
                                this.nt = e;
                                const n = $e(e, "i-amphtml-rendered") || Le(f, i, On);
                                (n.__AMP_RENDERED = !0), t.layoutSizeDefined && n.classList.add("i-amphtml-fill-content"), this.nt.appendChild(n);
                            } else {
                                const t = f.createElement("i-amphtml-c");
                                (this.nt = t), t.classList.add("i-amphtml-fill-content"), e || this.element.appendChild(t);
                            }
                        }
                        var u;
                        const f = this.nt;
                        q(f);
                        const { useContexts: h } = t,
                            d = this.tt;
                        if (0 != h.length && null == d) return;
                        const p = yn(t, this.element, this.Z, this.W, this.vt);
                        if ((this.updatePropsForRendering(p), !this.isReady(p))) return;
                        let v = Nt(t.Component, p);
                        for (let t = 0; t < h.length; t++) {
                            q(d);
                            const e = h[t].type,
                                n = d[t];
                            n && (v = Nt(e.Provider, { value: n }, v));
                        }
                        const m = Nt(ze, ct({}, this.F), v);
                        try {
                            if (this.ot) (this.ot = !1), ne(m, f);
                            else {
                                const t = i ? $e(f, "i-amphtml-rendered") : null;
                                t && (t.__AMP_RENDERED = !0), ee(m, f, null != t ? t : void 0);
                            }
                        } catch (t) {
                            var g;
                            throw (null === (g = this.et) || void 0 === g || g.reject(t), t);
                        }
                        n || e || this.mutateElement(() => Te(this.element, "amp:dom-update", void 0)), this.et && (this.et.resolve(void 0), (this.et = null));
                    }
                    getProp(t, e) {
                        return (n = this.W), (i = t), I.call(n, i) ? this.W[t] : e;
                        var n, i;
                    }
                    getApi() {
                        const t = this.H;
                        return t ? Promise.resolve(t) : (this.Y || (this.Y = new R()), this.Y.promise);
                    }
                    K(t) {
                        const e = Object.create(null),
                            n = Object.keys(t);
                        for (let t = 0; t < n.length; t++) {
                            const i = n[t];
                            this.kt(e, i);
                        }
                        (this.H = e), this.Y && (this.Y.resolve(e), (this.Y = null));
                    }
                    J(t) { }
                    triggerEvent(t, e, n) {
                        Te(t, e, n);
                    }
                    pauseCallback() {
                        if (this.constructor.unloadOnPause) this.mutateProps({ loading: "unload" }), (this.B = !0);
                        else {
                            var t;
                            const { G: e } = this;
                            null == e || null === (t = e.pause) || void 0 === t || t.call(e);
                        }
                    }
                    q(t) {
                        this.lt.updatePlaying(t);
                    }
                    kt(t, e) {
                        Object.defineProperty(t, e, {
                            configurable: !0,
                            get: () => {
                                const t = this.G;
                                return q(t), t[e];
                            },
                            set: (t) => {
                                const n = this.G;
                                q(n), (n[e] = t);
                            },
                        });
                    }
                };
            function Mn(t) {
                for (let e = 0; e < t.length; e++) {
                    const n = t[e];
                    if (z(n)) {
                        if (n.__AMP_RENDERED || n.tagName.startsWith("I-") || "i-amphtml-svc" == n.getAttribute("slot")) continue;
                        return !0;
                    }
                    if (3 == n.nodeType) return !0;
                }
                return !1;
            }
            function An(t, e) {
                if (null == t) return {};
                var n,
                    i,
                    o = {},
                    r = Object.keys(t);
                for (i = 0; i < r.length; i++) (n = r[i]), e.indexOf(n) >= 0 || (o[n] = t[n]);
                return o;
            }
            (Pn.staticProps = void 0),
                (Pn.useContexts = []),
                (Pn.loadable = !1),
                (Pn.unloadOnPause = !1),
                (Pn.layoutSizeDefined = !1),
                (Pn.lightDomTag = ""),
                (Pn.usesTemplate = !1),
                (Pn.shadowCss = null),
                (Pn.usesShadowDom = !1),
                (Pn.detached = !1),
                (Pn.delegatesFocus = !1),
                (Pn.props = {});
            var Hn,
                Nn = ["ref"],
                Rn = ("undefined" != typeof Symbol && (null === (Hn = Symbol.for) || void 0 === Hn ? void 0 : Hn.call(Symbol, "react.forward_ref"))) || 3911,
                Dn = mt.__b;
            mt.__b = function (t) {
                var e;
                null !== (e = t.type) && void 0 !== e && e.Mt && t.ref && ((t.props.ref = t.ref), (t.ref = null)), null == Dn || Dn(t);
            };
            var jn = function (t) {
                function e(e) {
                    const { ref: n } = e,
                        i = An(e, Nn);
                    return t(i, n);
                }
                return (e.$$typeof = Rn), (e.render = e), (e.prototype.isReactComponent = !0), (e.Mt = !0), e;
            };
            function Wn(t) {
                return (Wn =
                    "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                        ? function (t) {
                            return typeof t;
                        }
                        : function (t) {
                            return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t;
                        })(t);
            }
            function Yn(t) {
                var e = (function (t, e) {
                    if ("object" !== Wn(t) || null === t) return t;
                    var n = t[Symbol.toPrimitive];
                    if (void 0 !== n) {
                        var i = n.call(t, "string");
                        if ("object" !== Wn(i)) return i;
                        throw new TypeError("@@toPrimitive must return a primitive value.");
                    }
                    return String(t);
                })(t);
                return "symbol" === Wn(e) ? e : String(e);
            }
            var In = [null, "paint", "layout", "content", "size", "size paint", "size layout", "strict"],
                Xn = { position: "relative", width: "100%", height: "100%" },
                Fn =
                    (jn(function (t, e) {
                        let n = "class",
                            {
                                as: i = "div",
                                children: o,
                                contentAs: r = "div",
                                contentClassName: s,
                                contentProps: l,
                                contentRef: a,
                                contentStyle: c,
                                layout: u = !1,
                                paint: f = !1,
                                size: h = !1,
                                style: d,
                                wrapperClassName: p,
                                wrapperStyle: v,
                                [n]: m,
                            } = t;
                        const g = (h ? 4 : 0) + (u ? 2 : 0) + (f ? 1 : 0);
                        return Nt(
                            i,
                            ct(
                                ct({}, An(t, ["as", "children", "contentAs", "contentClassName", "contentProps", "contentRef", "contentStyle", "layout", "paint", "size", "style", "wrapperClassName", "wrapperStyle", n].map(Yn))),
                                {},
                                { ref: e, class: `${m || ""} ${p || ""}`.trim() || null, style: ct(ct(ct({}, d), v), {}, { contain: In[g] }) }
                            ),
                            Nt(r, ct(ct({}, l), {}, { ref: a, class: s, style: ct(ct({}, h && Xn), {}, { overflow: f ? "hidden" : "visible" }, c) }), o)
                        );
                    }),
                        jn(function (t, e) {
                            let n = "class",
                                { as: i = "div", children: o, style: r, wrapperClassName: s, wrapperStyle: l, [n]: a } = t;
                            return Nt(i, ct(ct({}, An(t, ["as", "children", "style", "wrapperClassName", "wrapperStyle", n].map(Yn))), {}, { ref: e, class: `${a || ""} ${s || ""}`.trim() || null, style: ct(ct({}, r), l) }), o);
                        }));
            function Bn(t, e, n) {
                return e in t ? Object.defineProperty(t, e, { value: n, enumerable: !0, configurable: !0, writable: !0 }) : (t[e] = n), t;
            }
            function Vn(t, e) {
                var n = Object.keys(t);
                if (Object.getOwnPropertySymbols) {
                    var i = Object.getOwnPropertySymbols(t);
                    e &&
                        (i = i.filter(function (e) {
                            return Object.getOwnPropertyDescriptor(t, e).enumerable;
                        })),
                        n.push.apply(n, i);
                }
                return n;
            }
            function Un(t) {
                for (var e = 1; e < arguments.length; e++) {
                    var n = null != arguments[e] ? arguments[e] : {};
                    e % 2
                        ? Vn(Object(n), !0).forEach(function (e) {
                            Bn(t, e, n[e]);
                        })
                        : Object.getOwnPropertyDescriptors
                            ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(n))
                            : Vn(Object(n)).forEach(function (e) {
                                Object.defineProperty(t, e, Object.getOwnPropertyDescriptor(n, e));
                            });
                }
                return t;
            }
            var { hasOwnProperty: zn, toString: qn } = Object.prototype,
                Gn = /(?:^[#?]?|&)([^=&]+)(?:=([^&]*))?/g;
            function Zn(t, e = "") {
                try {
                    return decodeURIComponent(t);
                } catch (t) {
                    return e;
                }
            }
            function Kn(t, e = 0) {
                var n, i;
                return null !== (n = null !== (i = t.tabindex) && void 0 !== i ? i : t.tabIndex) && void 0 !== n ? n : e;
            }
            function Jn(t) {
                return Qn[t];
            }
            var Qn = {
                twitter: { shareEndpoint: "https://twitter.com/intent/tweet", defaultParams: { text: "TITLE", url: "CANONICAL_URL" }, defaultColor: "ffffff", defaultBackgroundColor: "1da1f2" },
                facebook: { shareEndpoint: "https://www.facebook.com/dialog/share", defaultParams: { href: "CANONICAL_URL" }, defaultColor: "1877f2", defaultBackgroundColor: "ffffff" },
                pinterest: { shareEndpoint: "https://www.pinterest.com/pin/create/button/", defaultParams: { url: "CANONICAL_URL", description: "TITLE" }, defaultColor: "e60023", defaultBackgroundColor: "ffffff" },
                linkedin: { shareEndpoint: "https://www.linkedin.com/shareArticle", defaultParams: { url: "CANONICAL_URL", mini: "true" }, defaultColor: "ffffff", defaultBackgroundColor: "0a66c2" },
                email: { shareEndpoint: "mailto:RECIPIENT", defaultParams: { subject: "TITLE", body: "CANONICAL_URL", recipient: "" }, defaultColor: "ffffff", defaultBackgroundColor: "000000", bindings: ["recipient"] },
                tumblr: { shareEndpoint: "https://www.tumblr.com/share/link", defaultParams: { name: "TITLE", url: "CANONICAL_URL" }, defaultColor: "ffffff", defaultBackgroundColor: "001935" },
                whatsapp: { shareEndpoint: "https://api.whatsapp.com/send", defaultParams: { text: "TITLE - CANONICAL_URL" }, defaultColor: "ffffff", defaultBackgroundColor: "25d366" },
                line: { shareEndpoint: "https://social-plugins.line.me/lineit/share", defaultParams: { text: "TITLE", url: "CANONICAL_URL" }, defaultColor: "ffffff", defaultBackgroundColor: "00b900" },
                sms: { shareEndpoint: "sms:", defaultParams: { body: "TITLE - CANONICAL_URL" }, defaultColor: "ffffff", defaultBackgroundColor: "000000" },
                system: { shareEndpoint: "navigator-share:", defaultParams: { text: "TITLE", url: "CANONICAL_URL" }, defaultColor: "ffffff", defaultBackgroundColor: "000000" },
            };
            function ti({ style: t, type: e }) {
                switch (e) {
                    case "FACEBOOK":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", {
                                fill: "currentColor",
                                d:
                                    "M44 22.134C44 9.90843 34.1516 0 22 0C9.84844 0 0 9.90843 0 22.134C0 33.1837 8.04375 42.34 18.5625 44V28.5321H12.9766V22.134H18.5625V17.2576C18.5625 11.7111 21.8453 8.6461 26.8727 8.6461C29.2789 8.6461 31.7969 9.0784 31.7969 9.0784V14.5254H29.0211C26.2883 14.5254 25.4375 16.2331 25.4375 17.9839V22.134H31.5391L30.5637 28.5321H25.4375V44C35.9562 42.34 44 33.1837 44 22.134Z",
                            })
                        );
                    case "PINTEREST":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", {
                                fill: "currentColor",
                                d:
                                    "M22.0181 0C9.8583 0 0 9.8421 0 21.9819C0 31.2993 5.799 39.2599 13.9901 42.4622C13.7907 40.7253 13.6276 38.0477 14.0626 36.148C14.4613 34.4293 16.6359 25.2204 16.6359 25.2204C16.6359 25.2204 15.9835 23.8997 15.9835 21.9638C15.9835 18.9062 17.7594 16.6266 19.9703 16.6266C21.855 16.6266 22.7611 18.0378 22.7611 19.7204C22.7611 21.602 21.565 24.4243 20.9308 27.0477C20.4052 29.2368 22.0362 31.028 24.1927 31.028C28.107 31.028 31.1153 26.903 31.1153 20.9688C31.1153 15.7039 27.3278 12.0312 21.9093 12.0312C15.6392 12.0313 11.9604 16.7171 11.9604 21.5658C11.9604 23.4474 12.6853 25.4737 13.5914 26.5773C13.7726 26.7944 13.7907 26.9934 13.7364 27.2105C13.5733 27.898 13.1927 29.3997 13.1202 29.7072C13.0296 30.1053 12.794 30.1957 12.3772 29.9967C9.62271 28.7122 7.90114 24.7138 7.90114 21.4753C7.90114 14.5461 12.939 8.17763 22.453 8.17763C30.0823 8.17763 36.0263 13.6053 36.0263 20.8783C36.0263 28.4589 31.2421 34.5559 24.6095 34.5559C22.3805 34.5559 20.2784 33.398 19.5716 32.023C19.5716 32.023 18.4662 36.2204 18.1944 37.2516C17.7051 39.1694 16.364 41.5576 15.458 43.023C17.5238 43.6562 19.6985 44 21.9818 44C34.1416 44 43.9999 34.1579 43.9999 22.0181C44.0361 9.8421 34.1778 0 22.0181 0Z",
                            })
                        );
                    case "LINKEDIN":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", {
                                fill: "currentColor",
                                d:
                                    "M15.1765 33H10.4706V15.7044H15.1765V33ZM12.8235 13.6604C11.2549 13.6604 10 12.4025 10 10.8302C10 9.25786 11.2549 8 12.8235 8C14.3922 8 15.4902 9.41509 15.4902 10.9874C15.4902 12.5597 14.3922 13.6604 12.8235 13.6604ZM34 33H29.2941V24.195C29.2941 18.8491 23.0196 19.3208 23.0196 24.195V33H18.3137V15.7044H23.0196V18.5346C25.2157 14.4465 34 14.1321 34 22.4654V33Z",
                            })
                        );
                    case "EMAIL":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", {
                                fill: "currentColor",
                                d:
                                    "M31.6 12H12.4C11.08 12 10 13.08 10 14.4V28.8C10 30.12 11.08 31.2 12.4 31.2H31.6C32.92 31.2 34 30.12 34 28.8V14.4C34 13.08 32.92 12 31.6 12ZM30.64 14.4L22 20.16L13.36 14.4H30.64ZM12.4 28.8V16.644L22 23.04L31.6 16.644V28.8H12.4Z",
                            })
                        );
                    case "TWITTER":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", {
                                fill: "currentColor",
                                d:
                                    "M16.974 32.605C26.731 32.605 32.066 24.52 32.066 17.513C32.066 17.282 32.066 17.051 32.055 16.831C33.089 16.083 33.991 15.148 34.706 14.081C33.76 14.499 32.737 14.785 31.659 14.917C32.759 14.257 33.595 13.223 33.991 11.98C32.968 12.585 31.835 13.025 30.625 13.267C29.657 12.233 28.282 11.595 26.753 11.595C23.827 11.595 21.451 13.971 21.451 16.897C21.451 17.315 21.495 17.722 21.594 18.107C17.183 17.887 13.278 15.775 10.66 12.563C10.209 13.344 9.945 14.257 9.945 15.225C9.945 17.062 10.88 18.69 12.31 19.636C11.441 19.614 10.627 19.372 9.912 18.976C9.912 18.998 9.912 19.02 9.912 19.042C9.912 21.616 11.738 23.75 14.169 24.245C13.729 24.366 13.256 24.432 12.772 24.432C12.431 24.432 12.101 24.399 11.771 24.333C12.442 26.445 14.4 27.974 16.721 28.018C14.906 29.437 12.618 30.284 10.132 30.284C9.703 30.284 9.285 30.262 8.867 30.207C11.188 31.725 13.982 32.605 16.974 32.605Z",
                            })
                        );
                    case "TUMBLR":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", {
                                fill: "currentColor",
                                d:
                                    "M23.7527 26.9388C23.7527 28.9311 24.7623 29.6046 26.3327 29.6046H28.6042V34.6556H24.3136C20.4716 34.6556 17.5832 32.6632 17.5832 27.9209V20.3163H14.0778V16.2194C17.9477 15.2092 19.5462 11.8979 19.7425 9.00763H23.7527V15.5459H28.4079V20.3163H23.7527V26.9388Z",
                            })
                        );
                    case "WHATSAPP":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", {
                                "fill-rule": "evenodd",
                                "clip-rule": "evenodd",
                                d:
                                    "M31.9103 12.0713C29.284 9.44357 25.7823 8 22.0535 8C14.3752 8 8.12029 14.2267 8.1136 21.8703C8.1136 24.3184 8.75513 26.6999 9.97136 28.8087L8 36L15.3909 34.0708C17.4291 35.1751 19.7212 35.7605 22.0535 35.7605H22.0601C29.7384 35.7605 35.9933 29.5339 36 21.8836C35.9933 18.1782 34.5432 14.6923 31.9103 12.0713ZM22.0535 33.4122C19.9685 33.4122 17.9303 32.8534 16.1527 31.8023L15.7317 31.5495L11.348 32.6938L12.5174 28.4362L12.2434 27.9972C11.0807 26.1611 10.4726 24.039 10.4726 21.8636C10.4726 15.5172 15.6716 10.3416 22.0601 10.3416C25.1542 10.3416 28.0611 11.5457 30.253 13.7211C32.4382 15.9031 33.6411 18.7969 33.6411 21.8769C33.6344 28.2433 28.4353 33.4122 22.0535 33.4122ZM28.4086 24.7774C28.0611 24.6044 26.3504 23.7662 26.0296 23.6465C25.7088 23.5334 25.4749 23.4735 25.2477 23.8194C25.0138 24.1654 24.3456 24.9503 24.1451 25.1765C23.9446 25.4094 23.7375 25.436 23.39 25.263C23.0425 25.09 21.9198 24.7242 20.59 23.54C19.5542 22.622 18.8592 21.4844 18.652 21.1385C18.4516 20.7926 18.632 20.6063 18.8057 20.4334C18.9594 20.2804 19.1532 20.0276 19.327 19.828C19.5007 19.6284 19.5609 19.4821 19.6745 19.2492C19.7881 19.0164 19.7346 18.8168 19.6477 18.6439C19.5609 18.4709 18.8659 16.7612 18.5718 16.0694C18.2912 15.3908 18.0038 15.484 17.79 15.4773C17.5895 15.464 17.3556 15.464 17.1217 15.464C16.8878 15.464 16.5136 15.5505 16.1928 15.8964C15.8721 16.2423 14.9766 17.0805 14.9766 18.7902C14.9766 20.4999 16.2263 22.143 16.4 22.3759C16.5737 22.6087 18.8525 26.1079 22.3475 27.6113C23.1761 27.9705 23.8243 28.1834 24.3322 28.3431C25.1675 28.6092 25.9227 28.5693 26.5241 28.4828C27.1924 28.383 28.5823 27.6446 28.8764 26.833C29.1637 26.0214 29.1637 25.3295 29.0768 25.1832C28.99 25.0368 28.7561 24.9503 28.4086 24.7774Z",
                                fill: "currentColor",
                            })
                        );
                    case "LINE":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", {
                                "fill-rule": "evenodd",
                                "clip-rule": "evenodd",
                                d:
                                    "M22.0233 7C30.86 7 38.0467 12.83 38.0467 20.0167C38.0467 22.8767 36.9467 25.48 34.5633 28.0467C31.2267 31.9333 23.71 36.6267 21.9867 37.36C20.3059 38.0395 20.5085 36.9401 20.5876 36.5112C20.5896 36.5004 20.5915 36.49 20.5933 36.48C20.63 36.26 20.8133 35.1233 20.8133 35.1233C20.8867 34.6833 20.9233 34.06 20.7767 33.6567C20.63 33.18 19.8967 32.96 19.3833 32.85C11.6833 31.8233 6 26.4333 6 20.0167C6 12.83 13.1867 7 22.0233 7ZM32.5967 18.3333C32.78 18.3333 32.89 18.1867 32.89 18.0033V16.8667C32.89 16.6833 32.7433 16.5367 32.5967 16.5367H28.1233C28.05 16.5367 27.9767 16.5733 27.9033 16.61C27.8667 16.6833 27.83 16.7567 27.83 16.83V23.7967C27.83 23.87 27.8667 23.9433 27.9033 24.0167C27.9767 24.0533 28.05 24.09 28.1233 24.09H32.5967C32.78 24.09 32.89 23.9433 32.89 23.76V22.6233C32.89 22.44 32.7433 22.2933 32.5967 22.2933H29.5533V21.2667H32.5967C32.78 21.2667 32.89 21.12 32.89 20.9367V19.8C32.89 19.6167 32.7433 19.47 32.5967 19.47H29.5533V18.3333H32.5967ZM12.9067 22.44H15.95C16.1333 22.44 16.28 22.5867 16.17 22.6967V23.8333C16.17 24.0167 16.06 24.1633 15.8767 24.1633H11.4033C11.33 24.1633 11.2567 24.1267 11.1834 24.09L11.1833 24.09C11.1467 24.0167 11.11 23.9433 11.11 23.87V16.9033C11.11 16.72 11.2567 16.5733 11.44 16.5733H12.5767C12.76 16.5733 12.9067 16.72 12.9067 16.9033V22.44ZM18.6633 16.61H17.5267C17.3433 16.61 17.1967 16.7567 17.1967 16.9033V23.87C17.1967 24.0533 17.3433 24.1633 17.5267 24.1633H18.6633C18.8467 24.1633 18.9933 24.0166 18.9933 23.87V16.9033C18.9933 16.7567 18.8467 16.61 18.6633 16.61ZM26.4 16.61H25.3C25.1167 16.61 24.97 16.7567 24.97 16.9033V21.0467L21.78 16.72C21.78 16.72 21.78 16.6833 21.7433 16.6833L21.7067 16.6467H21.67H20.5333C20.35 16.6467 20.2033 16.7933 20.2033 16.94V23.9067C20.2033 24.09 20.35 24.2 20.5333 24.2H21.67C21.8533 24.2 22 24.0533 22 23.9067V19.7633L25.19 24.09C25.204 24.104 25.2127 24.118 25.2201 24.13C25.232 24.1493 25.2407 24.1633 25.2633 24.1633H25.3H25.3367H25.41H26.4C26.5833 24.1633 26.73 24.0167 26.73 23.87V16.9033C26.73 16.7567 26.5833 16.61 26.4 16.61Z",
                                fill: "currentColor",
                            })
                        );
                    case "SMS":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", { fill: "currentColor", d: "M30.8 12H13.2C11.99 12 11 12.99 11 14.2V34L15.4 29.6H30.8C32.01 29.6 33 28.61 33 27.4V14.2C33 12.99 32.01 12 30.8 12ZM30.8 27.4H13.2V14.2H30.8V27.4Z" })
                        );
                    case "SYSTEM":
                        return Nt(
                            "svg",
                            { style: t, "data-type": e, viewBox: "0 0 44 44" },
                            Nt("path", {
                                fill: "currentColor",
                                d:
                                    "M27.6667 26.5556C26.7889 26.5556 26 26.9 25.4111 27.4556L17.5667 22.8889C17.6222 22.6333 17.6667 22.3778 17.6667 22.1111C17.6667 21.8444 17.6222 21.5889 17.5667 21.3333L25.4 16.7667C25.9889 17.3222 26.7889 17.6667 27.6667 17.6667C29.5111 17.6667 31 16.1778 31 14.3333C31 12.4889 29.5111 11 27.6667 11C25.8222 11 24.3333 12.4889 24.3333 14.3333C24.3333 14.6 24.3778 14.8667 24.4333 15.1111L16.6 19.6778C16 19.1222 15.2111 18.7778 14.3333 18.7778C12.4889 18.7778 11 20.2667 11 22.1111C11 23.9556 12.4889 25.4444 14.3333 25.4444C15.2111 25.4444 16 25.1 16.6 24.5444L24.4333 29.1222C24.3778 29.3667 24.3333 29.6222 24.3333 29.8889C24.3333 31.7333 25.8222 33.2222 27.6667 33.2222C29.5111 33.2222 31 31.7333 31 29.8889C31 28.0444 29.5111 26.5556 27.6667 26.5556ZM27.6667 13.2222C28.2778 13.2222 28.7778 13.7222 28.7778 14.3333C28.7778 14.9444 28.2778 15.4444 27.6667 15.4444C27.0556 15.4444 26.5556 14.9444 26.5556 14.3333C26.5556 13.7222 27.0556 13.2222 27.6667 13.2222ZM14.3333 23.2222C13.7222 23.2222 13.2222 22.7222 13.2222 22.1111C13.2222 21.5 13.7222 21 14.3333 21C14.9444 21 15.4444 21.5 15.4444 22.1111C15.4444 22.7222 14.9444 23.2222 14.3333 23.2222ZM27.6667 31C27.0556 31 26.5556 30.5 26.5556 29.8889C26.5556 29.2778 27.0556 28.7778 27.6667 28.7778C28.2778 28.7778 28.7778 29.2778 28.7778 29.8889C28.7778 30.5 28.2778 31 27.6667 31Z",
                            })
                        );
                    default:
                        return Nt("svg", { style: t, "data-type": e });
                }
            }
            var { isArray: ei } = Array;
            self.__AMP_LOG = self.__AMP_LOG || { user: null, dev: null, userForEmbed: null };
            var ni = self.__AMP_LOG;
            function ii(t, e, n, i) {
                let o;
                try {
                    o = t.open(e, n, i);
                } catch (t) {
                    (
                        ni.dev ||
                        (ni.dev = (function (t, e) {
                            throw new Error("failed to call initLogConstructor");
                        })())
                    ).error("DOM", "Failed to open url on target: ", n, t);
                }
                var r, s;
                return !o && "_top" != n && ("number" != typeof s && (s = 0), s + 8 > (r = i || "").length || -1 === r.indexOf("noopener", s)) && (o = t.open(e, "_top")), o;
            }
            new Set(["c", "v", "a", "ad"]);
            var oi = ["background", "children", "color", "endpoint", "height", "params", "style", "target", "type", "width"],
                ri = "BentoSocialShare";
            function si(t) {
                console.warn(t);
            }
            function li(t, e) {
                const n = t.split(":", 1)[0];
                if ("navigator-share" === n)
                    if (window && window.navigator && window.navigator.share) {
                        const e = (function (t) {
                            const e = Object.create(null);
                            if (!t) return e;
                            let n;
                            for (; (n = Gn.exec(t));) {
                                const t = Zn(n[1], n[1]),
                                    i = n[2] ? Zn(n[2].replace(/\+/g, " "), n[2]) : "";
                                e[t] = i;
                            }
                            return e;
                        })(
                            (function (t) {
                                let e = t.indexOf("?"),
                                    n = t.indexOf("#");
                                return (e = -1 === e ? t.length : e), (n = -1 === n ? t.length : n), t.slice(e, n);
                            })(t)
                        );
                        window.navigator.share(e).catch((t) => {
                            si(`${t.message}. ${ri}`);
                        });
                    } else si(`Could not complete system share.  Navigator unavailable. ${ri}`);
                else
                    "sms" === n || "mailto" === n
                        ? ii(
                            window,
                            "sms" === n ? t.replace("?", "?&") : t,
                            window && window.navigator && window.navigator.userAgent && window.navigator.userAgent.search(/iPhone|iPad|iPod/i) >= 0 ? "_top" : e,
                            "resizable,scrollbars,width=640,height=480"
                        )
                        : ii(window, t, e, "resizable,scrollbars,width=640,height=480");
            }
            var ai = class extends Pn { };
            (ai.Component = function (t) {
                let { background: e, children: n, color: i, endpoint: o, height: r, params: s, style: l, target: a, type: c, width: u } = t,
                    f = (function (t, e) {
                        if (null == t) return {};
                        var n,
                            i,
                            o = {},
                            r = Object.keys(t);
                        for (i = 0; i < r.length; i++) (n = r[i]), e.indexOf(n) >= 0 || (o[n] = t[n]);
                        return o;
                    })(t, oi);
                !(function () {
                    const { notify: t } = qe();
                    fe(() => {
                        t && t();
                    });
                })();
                const h = (function (t, e, n, i, o, r) {
                    const s = Jn(t) || {};
                    let l = e || s.shareEndpoint;
                    if (void 0 === l) return si(`An endpoint is required if not using a pre-configured type. ${ri}`), null;
                    const a = Object.entries(s.defaultParams || {}).reduce((t, [e, n]) => {
                        var i;
                        return t[e]
                            ? t
                            : Un(Un({}, t), {}, { [e]: n.replace("TITLE", document.title).replace("CANONICAL_URL", (null === (i = document.querySelector("link[rel='canonical']")) || void 0 === i ? void 0 : i.href) || location.href) });
                    }, r || {});
                    "email" !== t || e || (l = `mailto:${a.recipient || ""}`);
                    const c = (function (t, e) {
                        return (function (t, e, n) {
                            if (!e) return t;
                            const i = t.split("#", 2),
                                o = i[0].split("?", 2);
                            let r = o[0] + (o[1] ? `?${o[1]}&${e}` : `?${e}`);
                            return (r += i[1] ? `#${i[1]}` : ""), r;
                        })(
                            t,
                            (function (t) {
                                const e = [];
                                for (const r in t) {
                                    let s = t[r];
                                    if (null != s) {
                                        s = ei((o = s)) ? o : [o];
                                        for (let t = 0; t < s.length; t++) e.push(((n = r), (i = s[t]), `${encodeURIComponent(n)}=${encodeURIComponent(i)}`));
                                    }
                                }
                                var n, i, o;
                                return e.join("&");
                            })(e)
                        );
                    })(l, a);
                    return { finalEndpoint: c, checkedWidth: i || 60, checkedHeight: o || 44, checkedTarget: n || "_blank" };
                })(c, o, a, u, r, s);
                if (!h) return null;
                const { checkedHeight: d, checkedTarget: p, checkedWidth: v, finalEndpoint: m } = h;
                return Nt(
                    Fn,
                    Un(
                        Un({}, f),
                        {},
                        {
                            role: "button",
                            tabindex: Kn(f),
                            onKeyDown: (t) =>
                                (function (t, e, n) {
                                    const { key: i } = t;
                                    (" " != i && "Enter" != i) || (t.preventDefault(), li(e, n));
                                })(t, m, p),
                            onClick: () => li(m, p),
                            wrapperStyle: Un({ width: v, height: d }, l),
                            part: "button",
                            wrapperClassName: "button-923d69b",
                        }
                    ),
                    (function (t, e, n, i) {
                        if (e) return e;
                        {
                            const e = Jn(t) || {};
                            return Nt(ti, { style: Un(Un({}, { color: n || e.defaultColor, backgroundColor: i || e.defaultBackgroundColor }), {}, { width: "100%", height: "100%" }), type: t.toUpperCase() });
                        }
                    })(c, n, i, e)
                );
            }),
                (ai.layoutSizeDefined = !0),
                (ai.delegatesFocus = !0),
                (ai.props = { children: { passthroughNonEmpty: !0 }, height: { attr: "height" }, tabindex: { attr: "tabindex" }, type: { attr: "type" }, width: { attr: "width" } }),
                (ai.staticProps = { color: "currentColor", background: "inherit" }),
                (ai.usesShadowDom = !0),
                (ai.shadowCss = ".button-923d69b{cursor:pointer;position:relative;text-decoration:none}.button-923d69b:focus{outline:2px solid #0389ff;outline-offset:2px}");
            var ci = n(311);
            function ui(t) {
                return (
                    (ui =
                        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                            ? function (t) {
                                return typeof t;
                            }
                            : function (t) {
                                return t && "function" == typeof Symbol && t.constructor === Symbol && t !== Symbol.prototype ? "symbol" : typeof t;
                            }),
                    ui(t)
                );
            }
            function fi() {
                fi = function () {
                    return e;
                };
                var t,
                    e = {},
                    n = Object.prototype,
                    i = n.hasOwnProperty,
                    o =
                        Object.defineProperty ||
                        function (t, e, n) {
                            t[e] = n.value;
                        },
                    r = "function" == typeof Symbol ? Symbol : {},
                    s = r.iterator || "@@iterator",
                    l = r.asyncIterator || "@@asyncIterator",
                    a = r.toStringTag || "@@toStringTag";
                function c(t, e, n) {
                    return Object.defineProperty(t, e, { value: n, enumerable: !0, configurable: !0, writable: !0 }), t[e];
                }
                try {
                    c({}, "");
                } catch (t) {
                    c = function (t, e, n) {
                        return (t[e] = n);
                    };
                }
                function u(t, e, n, i) {
                    var r = e && e.prototype instanceof g ? e : g,
                        s = Object.create(r.prototype),
                        l = new T(i || []);
                    return o(s, "_invoke", { value: E(t, n, l) }), s;
                }
                function f(t, e, n) {
                    try {
                        return { type: "normal", arg: t.call(e, n) };
                    } catch (t) {
                        return { type: "throw", arg: t };
                    }
                }
                e.wrap = u;
                var h = "suspendedStart",
                    d = "suspendedYield",
                    p = "executing",
                    v = "completed",
                    m = {};
                function g() { }
                function y() { }
                function _() { }
                var b = {};
                c(b, s, function () {
                    return this;
                });
                var w = Object.getPrototypeOf,
                    C = w && w(w(P([])));
                C && C !== n && i.call(C, s) && (b = C);
                var k = (_.prototype = g.prototype = Object.create(b));
                function x(t) {
                    ["next", "throw", "return"].forEach(function (e) {
                        c(t, e, function (t) {
                            return this._invoke(e, t);
                        });
                    });
                }
                function $(t, e) {
                    function n(o, r, s, l) {
                        var a = f(t[o], t, r);
                        if ("throw" !== a.type) {
                            var c = a.arg,
                                u = c.value;
                            return u && "object" == ui(u) && i.call(u, "__await")
                                ? e.resolve(u.__await).then(
                                    function (t) {
                                        n("next", t, s, l);
                                    },
                                    function (t) {
                                        n("throw", t, s, l);
                                    }
                                )
                                : e.resolve(u).then(
                                    function (t) {
                                        (c.value = t), s(c);
                                    },
                                    function (t) {
                                        return n("throw", t, s, l);
                                    }
                                );
                        }
                        l(a.arg);
                    }
                    var r;
                    o(this, "_invoke", {
                        value: function (t, i) {
                            function o() {
                                return new e(function (e, o) {
                                    n(t, i, e, o);
                                });
                            }
                            return (r = r ? r.then(o, o) : o());
                        },
                    });
                }
                function E(e, n, i) {
                    var o = h;
                    return function (r, s) {
                        if (o === p) throw new Error("Generator is already running");
                        if (o === v) {
                            if ("throw" === r) throw s;
                            return { value: t, done: !0 };
                        }
                        for (i.method = r, i.arg = s; ;) {
                            var l = i.delegate;
                            if (l) {
                                var a = O(l, i);
                                if (a) {
                                    if (a === m) continue;
                                    return a;
                                }
                            }
                            if ("next" === i.method) i.sent = i._sent = i.arg;
                            else if ("throw" === i.method) {
                                if (o === h) throw ((o = v), i.arg);
                                i.dispatchException(i.arg);
                            } else "return" === i.method && i.abrupt("return", i.arg);
                            o = p;
                            var c = f(e, n, i);
                            if ("normal" === c.type) {
                                if (((o = i.done ? v : d), c.arg === m)) continue;
                                return { value: c.arg, done: i.done };
                            }
                            "throw" === c.type && ((o = v), (i.method = "throw"), (i.arg = c.arg));
                        }
                    };
                }
                function O(e, n) {
                    var i = n.method,
                        o = e.iterator[i];
                    if (o === t)
                        return (
                            (n.delegate = null),
                            ("throw" === i && e.iterator.return && ((n.method = "return"), (n.arg = t), O(e, n), "throw" === n.method)) ||
                            ("return" !== i && ((n.method = "throw"), (n.arg = new TypeError("The iterator does not provide a '" + i + "' method")))),
                            m
                        );
                    var r = f(o, e.iterator, n.arg);
                    if ("throw" === r.type) return (n.method = "throw"), (n.arg = r.arg), (n.delegate = null), m;
                    var s = r.arg;
                    return s
                        ? s.done
                            ? ((n[e.resultName] = s.value), (n.next = e.nextLoc), "return" !== n.method && ((n.method = "next"), (n.arg = t)), (n.delegate = null), m)
                            : s
                        : ((n.method = "throw"), (n.arg = new TypeError("iterator result is not an object")), (n.delegate = null), m);
                }
                function S(t) {
                    var e = { tryLoc: t[0] };
                    1 in t && (e.catchLoc = t[1]), 2 in t && ((e.finallyLoc = t[2]), (e.afterLoc = t[3])), this.tryEntries.push(e);
                }
                function L(t) {
                    var e = t.completion || {};
                    (e.type = "normal"), delete e.arg, (t.completion = e);
                }
                function T(t) {
                    (this.tryEntries = [{ tryLoc: "root" }]), t.forEach(S, this), this.reset(!0);
                }
                function P(e) {
                    if (e || "" === e) {
                        var n = e[s];
                        if (n) return n.call(e);
                        if ("function" == typeof e.next) return e;
                        if (!isNaN(e.length)) {
                            var o = -1,
                                r = function n() {
                                    for (; ++o < e.length;) if (i.call(e, o)) return (n.value = e[o]), (n.done = !1), n;
                                    return (n.value = t), (n.done = !0), n;
                                };
                            return (r.next = r);
                        }
                    }
                    throw new TypeError(ui(e) + " is not iterable");
                }
                return (
                    (y.prototype = _),
                    o(k, "constructor", { value: _, configurable: !0 }),
                    o(_, "constructor", { value: y, configurable: !0 }),
                    (y.displayName = c(_, a, "GeneratorFunction")),
                    (e.isGeneratorFunction = function (t) {
                        var e = "function" == typeof t && t.constructor;
                        return !!e && (e === y || "GeneratorFunction" === (e.displayName || e.name));
                    }),
                    (e.mark = function (t) {
                        return Object.setPrototypeOf ? Object.setPrototypeOf(t, _) : ((t.__proto__ = _), c(t, a, "GeneratorFunction")), (t.prototype = Object.create(k)), t;
                    }),
                    (e.awrap = function (t) {
                        return { __await: t };
                    }),
                    x($.prototype),
                    c($.prototype, l, function () {
                        return this;
                    }),
                    (e.AsyncIterator = $),
                    (e.async = function (t, n, i, o, r) {
                        void 0 === r && (r = Promise);
                        var s = new $(u(t, n, i, o), r);
                        return e.isGeneratorFunction(n)
                            ? s
                            : s.next().then(function (t) {
                                return t.done ? t.value : s.next();
                            });
                    }),
                    x(k),
                    c(k, a, "Generator"),
                    c(k, s, function () {
                        return this;
                    }),
                    c(k, "toString", function () {
                        return "[object Generator]";
                    }),
                    (e.keys = function (t) {
                        var e = Object(t),
                            n = [];
                        for (var i in e) n.push(i);
                        return (
                            n.reverse(),
                            function t() {
                                for (; n.length;) {
                                    var i = n.pop();
                                    if (i in e) return (t.value = i), (t.done = !1), t;
                                }
                                return (t.done = !0), t;
                            }
                        );
                    }),
                    (e.values = P),
                    (T.prototype = {
                        constructor: T,
                        reset: function (e) {
                            if (((this.prev = 0), (this.next = 0), (this.sent = this._sent = t), (this.done = !1), (this.delegate = null), (this.method = "next"), (this.arg = t), this.tryEntries.forEach(L), !e))
                                for (var n in this) "t" === n.charAt(0) && i.call(this, n) && !isNaN(+n.slice(1)) && (this[n] = t);
                        },
                        stop: function () {
                            this.done = !0;
                            var t = this.tryEntries[0].completion;
                            if ("throw" === t.type) throw t.arg;
                            return this.rval;
                        },
                        dispatchException: function (e) {
                            if (this.done) throw e;
                            var n = this;
                            function o(i, o) {
                                return (l.type = "throw"), (l.arg = e), (n.next = i), o && ((n.method = "next"), (n.arg = t)), !!o;
                            }
                            for (var r = this.tryEntries.length - 1; r >= 0; --r) {
                                var s = this.tryEntries[r],
                                    l = s.completion;
                                if ("root" === s.tryLoc) return o("end");
                                if (s.tryLoc <= this.prev) {
                                    var a = i.call(s, "catchLoc"),
                                        c = i.call(s, "finallyLoc");
                                    if (a && c) {
                                        if (this.prev < s.catchLoc) return o(s.catchLoc, !0);
                                        if (this.prev < s.finallyLoc) return o(s.finallyLoc);
                                    } else if (a) {
                                        if (this.prev < s.catchLoc) return o(s.catchLoc, !0);
                                    } else {
                                        if (!c) throw new Error("try statement without catch or finally");
                                        if (this.prev < s.finallyLoc) return o(s.finallyLoc);
                                    }
                                }
                            }
                        },
                        abrupt: function (t, e) {
                            for (var n = this.tryEntries.length - 1; n >= 0; --n) {
                                var o = this.tryEntries[n];
                                if (o.tryLoc <= this.prev && i.call(o, "finallyLoc") && this.prev < o.finallyLoc) {
                                    var r = o;
                                    break;
                                }
                            }
                            r && ("break" === t || "continue" === t) && r.tryLoc <= e && e <= r.finallyLoc && (r = null);
                            var s = r ? r.completion : {};
                            return (s.type = t), (s.arg = e), r ? ((this.method = "next"), (this.next = r.finallyLoc), m) : this.complete(s);
                        },
                        complete: function (t, e) {
                            if ("throw" === t.type) throw t.arg;
                            return (
                                "break" === t.type || "continue" === t.type
                                    ? (this.next = t.arg)
                                    : "return" === t.type
                                        ? ((this.rval = this.arg = t.arg), (this.method = "return"), (this.next = "end"))
                                        : "normal" === t.type && e && (this.next = e),
                                m
                            );
                        },
                        finish: function (t) {
                            for (var e = this.tryEntries.length - 1; e >= 0; --e) {
                                var n = this.tryEntries[e];
                                if (n.finallyLoc === t) return this.complete(n.completion, n.afterLoc), L(n), m;
                            }
                        },
                        catch: function (t) {
                            for (var e = this.tryEntries.length - 1; e >= 0; --e) {
                                var n = this.tryEntries[e];
                                if (n.tryLoc === t) {
                                    var i = n.completion;
                                    if ("throw" === i.type) {
                                        var o = i.arg;
                                        L(n);
                                    }
                                    return o;
                                }
                            }
                            throw new Error("illegal catch attempt");
                        },
                        delegateYield: function (e, n, i) {
                            return (this.delegate = { iterator: P(e), resultName: n, nextLoc: i }), "next" === this.method && (this.arg = t), m;
                        },
                    }),
                    e
                );
            }
            function hi(t, e, n, i, o, r, s) {
                try {
                    var l = t[r](s),
                        a = l.value;
                } catch (t) {
                    return void n(t);
                }
                l.done ? e(a) : Promise.resolve(a).then(i, o);
            }
            !(function (t, e, n = self) {
                n.customElements.define(
                    t,
                    (function (t, e = self) {
                        return (
                            (Ne && Re === e) || (Ne = (Re = e).HTMLElement),
                            class extends Ne {
                                constructor() {
                                    super(), (this.implementation = new t(this));
                                }
                                connectedCallback() {
                                    this.classList.add("i-amphtml-built"), this.implementation.mountCallback(), this.implementation.buildCallback();
                                }
                                disconnectedCallback() {
                                    this.implementation.unmountCallback();
                                }
                                getApi() {
                                    return this.implementation.getApi();
                                }
                            }
                        );
                    })(e, n)
                );
            })("bento-social-share", ai, void 0),
                (function (t) {
                    t(document).ready(function () {
                        !(function (t) {
                            return function () {
                                var e = this,
                                    n = arguments;
                                return new Promise(function (i, o) {
                                    var r = t.apply(e, n);
                                    function s(t) {
                                        hi(r, i, o, s, l, "next", t);
                                    }
                                    function l(t) {
                                        hi(r, i, o, s, l, "throw", t);
                                    }
                                    s(void 0);
                                });
                            };
                        })(
                            fi().mark(function t() {
                                return fi().wrap(function (t) {
                                    for (; ;)
                                        switch ((t.prev = t.next)) {
                                            case 0:
                                                return (t.next = 2), customElements.whenDefined("bento-social-share");
                                            case 2:
                                            case "end":
                                                return t.stop();
                                        }
                                }, t);
                            })
                        )();
                        var e = t(".shares-popup__form");
                        function n() {
                            e.removeClass("active"), (a.popups.shares = !1), a.closeOverlay();
                        }
                        t(".js-shares-toggler").on("click", function (t) {
                            t.preventDefault(), e.hasClass("active") ? n() : (e.addClass("active"), (a.popups.shares = !0), a.openOverlay());
                        }),
                            t(".js-shares-popup-close").on("click", function (t) {
                                t.preventDefault(), n();
                            }),
                            t(document).mouseup(function (e) {
                                var i = t(".shares-popup__inner");
                                i.is(e.target) || 0 !== i.has(e.target).length || n();
                            }),
                            t(".js-shares-copy-link").on("click", function (t) {
                                t.preventDefault(), document.getElementById("shares-link-input").select(), document.execCommand("copy"), (0, c.alert)("Copied");
                            });
                    });
                })(ci),
                (function (t) {
                    t(document).ready(function () {
                        if (t("#back-to-top").length) {
                            var n = function () {
                                t(window).scrollTop() > 100 ? t("#back-to-top").addClass("show") : t("#back-to-top").removeClass("show");
                            };
                            n(),
                                t(window).on("scroll", function () {
                                    n();
                                }),
                                t("#back-to-top").on("click", function (e) {
                                    e.preventDefault(), t("html,body").animate({ scrollTop: 0 }, 700);
                                });
                        }
                        t(".js-scroll-link").on("click", function (e) {
                            e.preventDefault();
                            var n = this.hash,
                                i = t(n);
                            t("html, body")
                                .stop()
                                .animate({ scrollTop: i.offset().top - 50 }, 900, "swing", function () {
                                    window.location.hash = n;
                                });
                        }),
                            t(".search-form-send--js").on("click", function (e) {
                                e.preventDefault(), t(this).parents(".search-form").submit();
                            }),
                            t(".js-search-form-btn").on("click", function (e) {
                                e.preventDefault(), t(".search-form__popup").toggleClass("active"), t(this).toggleClass("active");
                            }),
                            t(document).mouseup(function (e) {
                                var n = t(".search-form");
                                n.is(e.target) || 0 !== n.has(e.target).length || (t(".search-form__popup").removeClass("active"), t(".js-search-form-btn").removeClass("active"));
                            }),
                            void 0 === e.get("_policy") && t(".privacy").show(),
                            t(".js-policy-agree").on("click", function (n) {
                                n.preventDefault(), t(".privacy").hide(), e.set("_policy", 1, { expires: 368, path: "/" });
                            }),
                            t(".js-slider-top").each(function () {
                                var e = t(this);
                                e.owlCarousel({ loop: !0, margin: 10, items: 6, responsive: { 0: { items: 1 }, 380: { items: 2 }, 520: { items: 3 }, 768: { items: 4 }, 992: { items: 5 }, 1200: { items: 9 } } }),
                                    e
                                        .parents(".top")
                                        .find(".js-slider-next")
                                        .on("click", function (t) {
                                            t.preventDefault(), e.trigger("next.owl.carousel");
                                        }),
                                    e
                                        .parents(".top")
                                        .find(".js-slider-prev")
                                        .on("click", function (t) {
                                            t.preventDefault(), e.trigger("prev.owl.carousel");
                                        });
                            });
                    }),
                        t(window).on("resize", function () { }),
                        t(window).on("load", function () { });
                })(n(311)),
                n.p,
                n.p,
                n.p,
                n.p,
                n.p;
        })();
})();
