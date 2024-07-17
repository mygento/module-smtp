## Mygento_Smtp module

Extends Magento_Email module.
The module adds a feature to log email messages to the database even when email sending is disabled.
Adds a blacklist to make it possible to skip sending emails to emails from the blacklist

## Admin panel
`Stores -> SMTP -> SMTP Log`: The grid with email logs 

## Configuration
Add Yes/No field `Log Email` to `Stores -> Configuration -> Advanced -> System -> Mail Sending Settings`   
Add days(int) field `Clean Email Log Every` to `Stores -> Configuration -> Advanced -> System -> Mail Sending Settings`   
Add regex with email to field `Blacklist` (could be multiline as several expr) to skip sending messages to these emails to `Stores -> Configuration -> Advanced -> System -> Mail Sending Settings`

## Plugins
* `aroundSendMessage`
    * original class: `\Magento\Framework\Mail\TransportInterface`
    * functionality: create Log record in DB

## How to use
1. Enable `Log Email` on the configuration page. It works independently from `Disable Email Communications` setting.