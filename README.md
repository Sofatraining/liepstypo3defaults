# Sitepackage for CMS TYPO3
## TYPO3 12.4 LTS
Description: This TYPO3-LTS12-Sitepackage will install flux, vhs and image_autoresize. Install Mask, powermail and news as you needed. It contains section-, container- and flux-templates for a bootstrap5 site, various menu-types and many more.

### Possible incompatibility between flux >= 10.0.0 and MASK Version 8 - TESTS NEEDED


See all features on -> https://v10.lieps.de/

### CHANGELOG
### v1 - Typo3 LTS 10.4
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
### v2 - Typo3 LTS 11.5  

#### v2.0.1  
Add Support for TYPO3 V11.5 LTS
***
#### v2.0.2  
Fix Powermail-Templates
***
#### v2.0.3
Add sourceset and webp for fluid -> rendering -> Image.html
***
#### v2.0.4
Small fixes + Adding AP-Box + Overwrite TCEFORM -> tt_content + Overwrite Fluid-Styled-Content > Partial > Header > All.html 
***
#### v2.0.5
Fixed Error in ext_emconf.php
***
#### v2.0.6
Adding Image-Gallery (rows) + New Menu (Fullscreen) + Update Bootstrap to 5.2.3 + Update Font Awesome to 6.2.1
***
#### v2.0.7
Element Buttons now with Positioning + Small Fixes + Disable TCA Header-Section for custom elements
Change from bootstrap.min.js to bootstrap.bundel.min.js
***
#### v2.0.8
Adding Timeline-Element, Cleaning Depends in emconf.php, Adding Autostart-Modalbox with Cookie-Handling (Disable after Closing for 5 Minutes), Adding new Menutypes and Chancing via Constants
***
#### v2.0.9
Column-Elemente überarbeitet (Spaltenbreiten für jede Spalte in allen Viewports anpassbar.), Update to BS 5.3.0, JQuery 3.7.0 and Font Awesome Free 6.4.0
***
### v3 - Typo3 LTS 12.4

#### v3.0.0
Package for TYPO3 V12.4, Required Flux 10.0.7 (Page-Template-Bug until 10.0.6), Update to BS 5.3.2, JQuery 3.7.1 and Font Awesome Free 6.4.2, Change Label Fields in Column-Elements
  
***   
  
## MANUAL
### Installation / Settings (translate later in english)
Um Timeouts bei der Extension-Installation zu vermeiden, sollten die abhängigen Extension vorher installiert werden. Das sind:
* mask
* news
* powermail
* vhs
* flux
* image_autoresize

```ini
[Template -> Enthält -> LIEPS TYPO3 Defaults (lieps_typo3_defaults) muss das letzte statische Template sein!!]
```   
![Extentions - statische Templates](https://user-images.githubusercontent.com/47626641/155408223-9910a40c-0790-4871-a944-ac08f29c6adb.png)
  
* Statische Templates wie im Screenshot hinzufügen
* SETTINGS -> Configure Extension -> Flux -> Disable Page Integration (Probably a bug in Flux 10.0.6)
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

#### Typ des Menüs ändern
Im Template kann über den Konstanteneditor der Typ des Menü gewählt werden. Notwendige JS- und CSS-Dateien werden automatisch über v:assets integriert.

![Template - Konstanteneditor](https://user-images.githubusercontent.com/47626641/253544264-d22e4b3c-a7d0-4996-b61d-698984f7b2f5.jpg)

Weitere Menütypen werden demnächst integriert
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
### Flux-Kesearch-Indexer
Falls KESEARCH im Einsatz ist:
* die Flux-Indexer-Extension findest Du hier -> https://extensions.typo3.org/extension/flux_kesearch_indexer
* Dokumentation unter https://github.com/MamounAlsmaiel/flux_kesearch_indexer

***   
## ToDo
* TCEFORM Overwrite for Header-Section
* Image sourceset and webp for Fluxtemplates
* image_autoresize Settings
