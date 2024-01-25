# Sitepackage for CMS TYPO3
## TYPO3 11.5 LTS and 12.4 LTS
Description: This TYPO3-LTS12-Sitepackage will install flux, vhs and image_autoresize. Install Mask, powermail and news as you needed. It contains section-, container- and flux-templates for a bootstrap5 site, various menu-types and many more. 

Demo: https://v12.lieps.de/

### Possible incompatibility between flux >= 10.0.0 and MASK Version 8 - MORE TESTS NEEDED
  
## MANUAL
### Installation / Settings
To avoid timeouts during extension installation, the dependent extensions should be installed beforehand. These are:
* vhs (needed)
* flux (needed)
* mask (optional)
* news (optional)
* powermail (optional)
* image_autoresize (optional)

```ini
[Template -> Enthält -> LIEPS TYPO3 Defaults (lieps_typo3_defaults) muss das letzte statische Template sein!!]
```   
![Extentions - statische Templates](https://user-images.githubusercontent.com/47626641/155408223-9910a40c-0790-4871-a944-ac08f29c6adb.png)
  
* Add static templates like in the screenshot
* (Bug only in Flux 10.0.6) SETTINGS -> Configure Extension -> Flux -> Disable Page Integration
* Update the language files after installation: Wartung -> Manage Languages -> Update all  
* !! IMPORTANT !! Generally allow webp as an image format in LocalConfiguration !!
```diff
$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'] = 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg,webp'; 
``` 
* Disable JS and CSS compression during development -> Setup
```diff
config {  
	compressJs = 0  
	compressCss = 0  
	concatenateJs = 0  
	concatenateCss = 0  
}  
```

#### Change menu type
The type of menu can be selected in the template using the constant editor. Necessary JS and CSS files are automatically integrated via v:assets.

![Template - Konstanteneditor](https://user-images.githubusercontent.com/47626641/253544264-d22e4b3c-a7d0-4996-b61d-698984f7b2f5.jpg)

More menu types will be integrated soon
***

### EXT:Fluid Styled Content
```ini
[Template -> Enthält -> "Fluid Content Elements (fluid_styled_content)" als erstes statische Template hinzufügen]  
[Template -> Enthält -> "Fluid Content Elements CSS (optional) (fluid_styled_content)" als zweites statische Template hinzufügen]
``` 
* Überschreibungen werden in den Ordnern 'ContentElements' in Resources/Privat abgelegt 
***

### Flux-Templates
* Templates werden in den Ordnern 'Content' in Resources/Privat abgelegt
* Provider-Extension wurde vollständig integriert
* Dokumentation unter https://fluidtypo3.org/documentation/templating-manual/introduction.html
***

### EXT:News (If in use)
```ini
[Template -> Enthält -> "News (news)" hinzufügen]   
``` 
* "News Styles Twitter Bootstrap V5 (news)" muss nicht mehr in die statischen Templates hinzugefügt werden
* Datumsformate und Linkbezeichnungen werden abhängig von der Spracheneinstellung in der Site-Config ausgegeben  
* Siteconfig (config.yaml) für sprechende URL's muss nach Konfiguration anpasst werden
* News-CSS liegt unter EXT:liepstypo3defaults/Resources/Public/Css/news-basic.css
***
  
### EXT:Powermail (If in use)
* Anpassungen für "Add classes and CSS based on bootstrap (powermail)" vorgenommen 
```ini
[Template -> Enthält -> "Main Template (powermail)" hinzufügen]
[Template -> Enthält -> "Add classes and CSS based on bootstrap (powermail)" unter "Main Template (powermail)" hinzufügen]  
```  
***
  
### EXT:Mask (If in use)
```ini
[Template -> Enthält -> "Mask (mask)" hinzufügen]
``` 
* Pfade eingeben in Einstellungen -> Extension Configuration -> mask 
* Nicht angegebene Felder leer lassen   
> general.loader_identifier
```diff
json
``` 
> general.json
```diff
EXT:liepstypo3defaults/Configuration/Mask/mask.json
```  
> general.backendlayout_pids
```diff
0,1
``` 
> frontend.content (folder):  
```diff
EXT:liepstypo3defaults/Resources/Private/Templates/Mask/Frontend/
```  
> frontend.layouts (folder)
```diff
EXT:liepstypo3defaults/Resources/Private/Layouts/Mask/Frontend/
```  
> frontend.partials (folder)
```diff
EXT:liepstypo3defaults/Resources/Private/Partials/Mask/Frontend/
```  
> backend.backend (folder)
```diff
EXT:liepstypo3defaults/Resources/Private/Templates/Mask/Backend/
```  
> backend.layouts_backend (folder)
```diff
EXT:liepstypo3defaults/Resources/Private/Layouts/Mask/Backend/
```  
> backend.partials_backend (folder)
```diff
EXT:liepstypo3defaults/Resources/Private/Partials/Mask/Backend/
```  

***
### Flux-Kesearch-Indexer
Falls KESEARCH im Einsatz ist:
* die Flux-Indexer-Extension findest Du hier -> https://extensions.typo3.org/extension/flux_kesearch_indexer
* Dokumentation unter https://github.com/MamounAlsmaiel/flux_kesearch_indexer

***   
## ToDo
* TCEFORM Overwrite for Header-Section
* Image sourceset and webp for Fluxtemplates
* image_autoresize Settings
