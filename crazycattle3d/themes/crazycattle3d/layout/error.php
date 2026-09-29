<style>
    .font-display {
        margin-top: 14px;
        overflow: hidden;
        -o-text-overflow: ellipsis;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 4;
        overflow-wrap: break-word;
    }

    .not_found_suggestions {
        margin-top: 22px;
        margin-bottom: 8px !important;
        font-weight: 600;
    }

    .keywords-found {
        color: var(--white2);
    }
</style>
<section class="area area--pattern">
    <div class="area__heading">
        <h1 class="area__title title">Search results: <em class='fw-bolder'><?php echo $keywords; ?></em></h1>
    </div>
    <div class="game__content">
        <span class="font-display">Your search - Did not match any documents.</span>
        <p class="not_found_suggestions">Suggestions:</p>
        <ul>
            <li>Make sure that all words are spelled correctly.</li>
            <li>Try different keywords.</li>
            <li>Try more general keywords.</li>
        </ul>
    </div>
</section>