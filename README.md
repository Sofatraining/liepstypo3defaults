# Sitepackage for CMS TYPO3
## TYPO3 11.5 LTS
Description: This TYPO3-LTSv10-Sitepackage will install flux, vhs, mask, image_autoresize, powermail and news. It contains section-, container- and flux-templates for a bootstrap5 site. 

See all features on -> https://v10.lieps.de/

### CHANGELOG

#### v1.0.0  
Intial Release - Original plugin from [https://www.sitepackagebuilder.com/](https://www.sitepackagebuilder.com/)
***
#### v1.0.1  
Changes in constants.typoscript and setup.typoscript to LIEPS-Defaults
***
#### v1.0.2  
Multiple changes (BE-layout + templates, RTE, install ext: image_autoresize, mask, powermail, news + bugfixes)
***
#### v1.0.3  
setup.typoscript + constants.typoscript + templatepath for news and powermail  
***
#### v1.0.4  
Add jquery magnific popup + add template and partials (fluid-styled-content) + code-cleaning + bugfixes  
***
#### v1.0.5  
new file-structure for TS-files + VHS and flux-integration + adding flux-templates  
***
#### v1.0.6  
Adding breadcrumb-menu with menuprocessor + adding BS5-styles to EXT:news + code-cleaning + bugfixes 
***
#### v1.0.7  
Fix for BS5-styles to EXT:news + font awesome 6 integration
***
#### v1.0.8  
Adding flux-templates for content-elements (teaser, accordion, tabs, carousel + carousel-image) + fix error for autoloading classes
***
#### v1.0.9  
Add lib.dynamicContentSlide + add flux-template for OffCanvas element + add option container-fluid to section template + add background-image to section template + fix error page-template None.html + finetuning 
***
#### v1.0.10  
Add new bootstrap menu + fix error section (BG-Image-Path) + add new PageTitleProvider + add flux-template for buttons 
***
#### v1.0.11  
Add fields for css-classes für row + col in container-elements
  
***
#### v2.0.1  
Add Support for TYPO3 V11.5 LTS
***
#### v2.0.2  
Fix Powermail-Templates
***
#### v2.0.3
Add sourceset and webp for fluid -> rendering -> Image.html
    
***   
  
## MANUAL
### Installation / Settings (will translate later in english)
```ini
[Template -> Enthält -> LIEPS TYPO3 Defaults (lieps_typo3_defaults) muss das letzte statische Template sein!!]
```   
![Extentions - statische Templates](https://user-images.githubusercontent.com/47626641/155408223-9910a40c-0790-4871-a944-ac08f29c6adb.png)
  
* Statische Templates wie im Screenshot hinzufügen
* Nach der Installation die Sprachdateien aktualisieren: Wartung -> Manage Languages -> Update all  
* !! WICHTIG !! webp generell als Bild-Format in LocalConfiguration zulassen
```diff
$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'] = 'gif,jpg,jpeg,tif,tiff,bmp,pcx,tga,png,pdf,ai,svg,webp'; 
``` 
* Während der Entwicklung JS und CSS Compression deaktivieren -> Setup 
```diff
config {  
	compressJs = 0  
	compressCss = 0  
	concatenateJs = 0  
	concatenateCss = 0  
}  
``` 
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

### EXT:News
```ini
[Template -> Enthält -> "News (news)" hinzufügen]   
``` 
* "News Styles Twitter Bootstrap V5 (news)" muss nicht mehr in die statischen Templates hinzugefügt werden
* Datumsformate und Linkbezeichnungen werden abhängig von der Spracheneinstellung in der Site-Config ausgegeben  
* Siteconfig (config.yaml) für sprechende URL's muss nach Konfiguration anpasst werden
* News-CSS liegt unter EXT:liepstypo3defaults/Resources/Public/Css/news-basic.css
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
## ToDo
* Image sourceset and webp for Fluxtemplates
* image_autoresize Settings
