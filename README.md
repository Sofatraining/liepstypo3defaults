# Sitepackage for "TYPO3 Defaults"
## TYPO3 10.4 LTS

### CHANGELOG

#### v1.0.0  
Intial Release - Original Plugin from [https://www.sitepackagebuilder.com/](https://www.sitepackagebuilder.com/)
***
#### v1.0.1  
Changes in constants.typoscript and setup.typoscript to LIEPS-Defaults
***
#### v1.0.2  
Multiple Changes (BE-Layout + Templates, RTE, Install Ext: image_autoresize, mask, powermail, news + Bugfixes)
***
#### v1.0.3  
setup.typoscript + constants.typoscript + Templatepfade für News und Powermail  + diverse Anpassungen  
***
#### v1.0.4  
Add Jquery Magnific Popup + Add Template und Partials (Fluid-Styles-Content) + Bugfixes  
  
***    
***   
  
## MANUAL  
### Installation / Settings 
```ini
[Template -> Enthält -> LIEPS TYPO3 Defaults (lieps_typo3_defaults) muss das letzte statische Template sein!!]
```  
* Nach der Installation die Sprachdateien aktualisieren: Wartung -> Manage Languages -> Update all
***

### EXT:Fluid Styled Content
```ini
[Template -> Enthält -> "Fluid Content Elements (fluid_styled_content)" als erstes statische Template hinzufügen]  
[Template -> Enthält -> "Fluid Content Elements CSS (optional) (fluid_styled_content)" als zweites statische Template hinzufügen]
``` 
* Überschreibungen werden in den Ordnern für ContentElements in Resources/Privat abgelegt 
***

### EXT:News
```ini
[Template -> Enthält -> "News (news)" hinzufügen]
``` 
* Datumsformate und Linkbezeichnungen werden abhängig von der Spracheneinstellung in der Site-Config ausgegeben  
* Siteconfig (config.yaml) für sprechende URL's muss nach Konfiguration anpasst werden
* News-CSS liegt unter lieps_typo3_defaults/Resources/Public/Css/news-basic.css
***
  
### EXT:Powermail
* Anpassungen für "Add classes and CSS based on bootstrap (powermail)" vorgenommen 
```ini
[Template -> Enthält -> "Main Template (powermail)" hinzufügen]
[Template -> Enthält -> "Add classes and CSS based on bootstrap (powermail)" unter "Main Template (powermail)" hinzufügen]  
```  
***
  
### EXT:Mask
```ini
[Template -> Enthält -> "Mask (mask)" hinzufügen]
``` 
* Pfade eingeben in Einstellungen -> Extension Configuration -> mask 
* Nicht angegebene Felder leer lassen   
> general.json
```diff
EXT:lieps_typo3_defaults/Configuration/Mask/mask.json
```  
> general.backendlayout_pids
```diff
0,1
``` 
> frontend.content (folder):  
```diff
EXT:lieps_typo3_defaults/Resources/Private/Templates/Mask/Frontend/
```  
> frontend.layouts (folder)
```diff
EXT:lieps_typo3_defaults/Resources/Private/Layouts/Mask/Frontend/
```  
> frontend.partials (folder)
```diff
EXT:lieps_typo3_defaults/Resources/Private/Partials/Mask/Frontend/
```  
> backend.backend (folder)
```diff
EXT:lieps_typo3_defaults/Resources/Private/Templates/Mask/Backend/
```  
> backend.layouts_backend (folder)
```diff
EXT:lieps_typo3_defaults/Resources/Private/Layouts/Mask/Backend/
```  
> backend.partials_backend (folder)
```diff
EXT:lieps_typo3_defaults/Resources/Private/Partials/Mask/Backend/
```  
  
      
***   
## ToDo
* cs_seo hinzufügen
* Image sourceset
* Webp
* image_autoresize Settings
* Menüprocessor für Breadcrumb
* ContentElemente über gridelements
