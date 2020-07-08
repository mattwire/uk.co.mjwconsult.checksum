{*
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC. All rights reserved.                        |
 |                                                                    |
 | This work is published under the GNU AGPLv3 license with some      |
 | permitted exceptions and without any warranty. For full license    |
 | and copyright information, see https://civicrm.org/licensing       |
 +--------------------------------------------------------------------+
*}

<div class="crm-accordion-wrapper">
  <div class="crm-accordion-header">Self-service links</div>
  <div class="crm-accordion-body">
    {if $cancelSubscriptionUrl}<a href="{$cancelSubscriptionUrl}">{ts}Cancel{/ts}</a> {/if}
    {if $updateSubscriptionBillingUrl}<a href="{$updateSubscriptionBillingUrl}">{ts}Update Billing Info{/ts}</a> {/if}
    {if $updateSubscriptionUrl}<a href="{$updateSubscriptionUrl}">{ts}Edit{/ts}</a> {/if}
  </div>
</div>
