{if $contactId}
  {capture assign=demoUrl}{crmURL p='civicrm/contribute/transact' q="reset=1&id=1&cid=" h=0 a=1 fe=1}{/capture}
  <div class="crm-block crm-form-block">
    <h2>Checksum</h2>
    <div class="help"><i class="crm-i fa fa-info-circle"></i> A contact checksum can be used to allow a user to access details from their contact record without being logged in - they don't even need to have a user account!
      <br /><i class="crm-i fa fa-info-circle"></i> Use the {literal} {contact.checksum} {/literal} token in your emails to generate personalised links.</div>
    <div class="crm-section">
      <strong>Checksum for contact Id {$contactId}:</strong>
      <br />{$checksum}
    </div>

    <h3>Examples</h3>
    <div class="help"><i class="crm-i fa fa-info-circle"></i> Customise the URL to match your site.  These examples use a contribution page with Id 1.</div>
    <div class="crm-section"><strong>An example to include in your email:</strong><br /> {$demoUrl}{literal}{contact.contact_id}&{contact.checksum}{/literal}</div>
    <div class="crm-section"><strong>An example for this contact:</strong><br /> {$demoUrl}{$contactId}&cs={$checksum}</div>
  </div>
{else}
  <div class="alert-error">No contactId specified!</div>
{/if}
{* FOOTER *}
<div class="crm-submit-buttons">
  {include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
