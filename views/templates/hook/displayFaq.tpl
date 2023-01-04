<div class="lfaq-container" >
    <div itemscope itemtype="http://schema.org/FAQPage">
        <h4 class="lfaq-title" >{l s='FAQ' mod='lfaq'}</h4>
        {foreach from=$faqs item=faq key=k}
            <div itemscope itemprop="mainEntity" itemtype="https://schema.org/Question"
                 data-toggle="collapse" data-target="#collapse{$k}" aria-expanded="false" aria-controls="collapse{$k}">
                <span class="lfaq-q-line">
                    <i class="material-icons arrow-down">&#xE313;</i>
                    <h3 class="lfaq-q" itemprop="name">{$faq['question']}</h3>
                </span>
                <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                    <div class="lfaq-a collapse" itemprop="text" class="collapse" id="collapse{$k}">
                        {$faq['answer'] nofilter}
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
</div>
