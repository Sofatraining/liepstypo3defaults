# Sitepackage for "TYPO3 Defaults"
## TYPO3 10.4 LTS with branch 11.5 LTS

### CHANGELOG

v1.0.0 Intial Release - Original Plugin from [https://www.sitepackagebuilder.com/](https://www.sitepackagebuilder.com/)
***
v1.0.1 Changes in constants.typoscript and setup.typoscript to our LIEPS-Defaults
***
v1.0.2 Multiple Changes (BE-Layout + Templates, RTE, Install Ext: image_autoresize, mask, powermail, news + Error Fixes)
***
v1.0.3 setup.typoscript + constants.typoscript + Templatepfade für News und Powermail  
  
      
***   
### Manual  
#### Settings  
```diff
- Template -> Enthält -> LIEPS TYPO3 Defaults (lieps_typo3_defaults) muss  **letztes ausgewähltes Objekt** sein!!  
```
  
#### EXT:Mask
> **Pfade für Mask**  -> Einstellungen -> Extension Configuration -> mask  
> general.json -> EXT:lieps_typo3_defaults/Configuration/Mask/mask.json  
> general.backendlayout_pids -> 0,1  
> frontend.content (folder) -> EXT:lieps_typo3_defaults/Resources/Private/Templates/Mask/Frontend/  
> frontend.layouts (folder) -> EXT:lieps_typo3_defaults/Resources/Private/Layouts/Mask/Frontend/  
> frontend.partials (folder) -> EXT:lieps_typo3_defaults/Resources/Private/Partials/Mask/Frontend/  
> backend.backend (folder) -> EXT:lieps_typo3_defaults/Resources/Private/Templates/Mask/Backend/  
> backend.layouts_backend (folder) -> EXT:lieps_typo3_defaults/Resources/Private/Layouts/Mask/Backend/  
> backend.partials_backend (folder) -> EXT:lieps_typo3_defaults/Resources/Private/Partials/Mask/Backend/  


