# uk.co.mjwconsult.checksum
Access to checksum functionality via API and contact record in CiviCRM

## API functions

| Function  | Parameters | Returns | 
| ------------- | ------------- | ------------- | 
| ContactChecksum.generate  | id=contactId | values['checksum'] |
| ContactChecksum.validate  | id=contactId,checksum=checksum | values['checksum'] = true/false |
| ContactChecksum.gettimeoutdays | | values['days'] |

## Contact actions
A new action "Contact Checksum" loads a form with examples of how to use the checksum in emails etc:
![Screenshot](/docs/checksum_screenshot.png)
