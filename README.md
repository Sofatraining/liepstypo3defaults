# Sitepackage for "TYPO3 Defaults"
## TYPO3 10.4 LTS

### CHANGELOG

v1.0.0 Intial Release - Original Plugin from [https://www.sitepackagebuilder.com/](https://www.sitepackagebuilder.com/)
***
v1.0.1 Changes in constants.typoscript and setup.typoscript to our LIEPS-Defaults
***
v1.0.2 Multiple Changes (BE-Layout + Templates, RTE, Install Ext: image_autoresize, mask, powermail, news + Bugfixes)
***
v1.0.3 setup.typoscript + constants.typoscript + Templatepfade für News und Powermail  
  
      
***   
## MANUAL  
### Settings
```ini
[Template -> Enthält -> LIEPS TYPO3 Defaults (lieps_typo3_defaults) muss letztes ausgewähltes Objekt sein!!]
``` 
***
  
### EXT:News
* Datumsformate und Linkbezeichnungen werden abhängig von der Spracheneinstellung in der Site-Config ausgegeben.  
* Siteconfig (config.yaml) für sprechende URL anpassen
***
  
### EXT:Powermail
* Anpassungen für "Add classes and CSS based on bootstrap (powermail)"  
* Template -> Enthält -> "Add classes and CSS based on bootstrap (powermail)" unter "Main Template (powermail)" hinzufügen!!
***
  
### EXT:Mask
* Pfade eingeben in Einstellungen -> Extension Configuration -> mask  
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


