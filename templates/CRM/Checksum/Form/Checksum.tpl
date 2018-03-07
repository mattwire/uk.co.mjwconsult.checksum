{if $contactId}
  <div class="crm-block crm-form-block">
    <div class="help">
      <ul>
        <li>{ts}A contact checksum is used to allow a contact to access details from their contact record without being logged in - they don't even need to have a user account!{/ts}</li>
        <li>{ts}Use the{/ts} {literal} {contact.checksum} {/literal} {ts}token in your emails to generate personalised links.{/ts}</li>
        <li>{ts}Each time you load this page the checksum will be different because part of it is calculated based on a number of different parameters including an expiry time{/ts}</li>
      </ul>
    </div>
    <div class="crm-section">
      <h3>{ts 1=$contactId} Checksum for contact ID %1{/ts}: {$checksum}</h3>
      <h3>{ts 1=$checksumExpiryDays}The checksum expires after %1 days{/ts}</h3>
      {capture assign=adminUrl}{crmURL p='civicrm/admin/setting/misc' q="reset=1" h=0 a=1 fe=1}{/capture}
      {ts}If you wish to change the expiry time you go to {/ts}<a href="{$adminUrl}">Administer->System Settings->Misc</a> {ts}and change the "Checksum Lifespan".{/ts}
    </div>

    <h2>{ts}Examples{/ts}</h2>
    <div class="help"><i class="crm-i fa fa-info-circle"></i> {ts}Customise the URL to match your site.  These examples use a contribution page with Id 1.{/ts}</div>
    <div class="crm-section">
      {capture assign=contributionUrl}{crmURL p='civicrm/contribute/transact' q="id=1&cid=" h=0 a=1 fe=1}{/capture}
      {capture assign=profileUrl}{crmURL p='civicrm/profile/edit' q="gid=1&id=" h=0 a=1 fe=1}{/capture}
      <h3>An example to include in an email that you send from CiviCRM:</h3>
      <div class="label">A Contribution page</div><div class="content">{$contributionUrl}{literal}{contact.contact_id}&cs={contact.checksum}{/literal}</div>
      <div class="label">A Profile</div><div class="content">{$profileUrl}{literal}{contact.contact_id}&cs={contact.checksum}{/literal}</div>
    </div>
    <div class="crm-section">
      <h3>An example to include in an email that you send via an external email system (you will need to copy/paste separately for each contact as the checksums are different / or include the checksum in your contact export):</h3>
      <div class="label">A Contribution page</div><div class="content">{$contributionUrl}{$contactId}&cs={$checksum}</div>
      <div class="label">A Profile</div><div class="content">{$profileUrl}{$contactId}&cs={$checksum}</div>
    </div>
  </div>
{else}
  <div class="alert-error">No contact ID specified!</div>
{/if}
{* FOOTER *}
<div class="crm-submit-buttons">
  {include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
