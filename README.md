# Sitepackage for CMS TYPO3
## TYPO3 14.3 LTS – v5.0.0 (development)

This sitepackage provides Bootstrap 5 page templates, content elements and navigation variants based on Flux, VHS and Content Blocks. Optional extensions such as News, Powermail, Mask and image_autoresize require separate TYPO3-14.3 compatibility checks.

**Release status:** The TYPO3 14.3 migration is taking place in `v14-dev` and has not yet been fully tested. `v14-main` is reserved for the later stable v5.0.0 release and currently still reflects the TYPO3-13 codebase. Do not use `v14-main` as a TYPO3-14.3-compatible release yet.

**Requirements for v5.0.0 / v14-dev:** PHP `^8.3`, TYPO3 `^14.3.7`, Content Blocks `^2.4.10`, Flux `^12.0.2` and VHS `^8.0.0`. See `composer.json` for the authoritative constraints.

## MANUAL
### Installation / Settings
To avoid timeouts during extension installation, the dependent extensions should be installed beforehand. These are:
* vhs (needed)
* flux (needed)
* content_blocks (needed)

#### Installation via git clone
Stable (planned; v14-main is not yet ready for TYPO3 14.3)
* Under /typo3conf/ext/ -> git clone --branch v14-main https://github.com/Sofatraining/liepstypo3defaults.git

Development (TYPO3 14.3 migration; not yet production-ready)
* Under /typo3conf/ext/ -> git clone --branch v14-dev https://github.com/Sofatraining/liepstypo3defaults.git

#### Settings

```ini
[Template -> Enthält -> LIEPS TYPO3 Defaults (lieps_typo3_defaults) muss das letzte statische Template sein!!]
```   
![Extentions - statische Templates](https://user-images.githubusercontent.com/47626641/155408223-9910a40c-0790-4871-a944-ac08f29c6adb.png)
  
* Add static templates like in the screenshot (should be the last entry)
* Update the language files after installation: Wartung -> Manage Languages -> Update all  
* TYPO3 14 has removed frontend CSS/JavaScript compression and concatenation. Do **not** configure `config.compressJs`, `config.compressCss`, `config.concatenateJs` or `config.concatenateCss` (not even with `0` during development).
* The existing minified CSS and JavaScript resources are still included through `page.includeCSS*` and `page.includeJS*`. Asset optimization belongs to the build process (see `Build/package.json`), not to TypoScript runtime configuration.
* Obsolete configuration such as `config.absRefPrefix` and `config.linkVars = L`, as well as the `TSFE:id` fallback in `lib.dynamicContent`, has also been removed/replaced for TYPO3 14.

#### Change menu type
The type of menu can be selected in the template using the constant editor. The corresponding CSS and JavaScript files are registered via TYPO3's `f:asset.css` and `f:asset.script` ViewHelpers (AssetCollector); VHS 8 no longer provides `v:asset.*`.

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
## ToDo (TYPO3 14.3 migration)
* Validate Flux 12 / VHS 8 rendering and existing nested content and FlexForm data.
* Validate Content Blocks 2.x definitions and update the CKEditor configuration.
* Review remaining hard-coded asset URLs and test the TYPO3 14.3 installation before releasing `v14-main`.
