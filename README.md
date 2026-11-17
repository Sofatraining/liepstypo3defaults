# LIEPS TYPO3 Defaults
## Sitepackage für TYPO3 14.3 – Version 5

Diese Extension stellt auf Bootstrap 5 basierende Seitentemplates, Inhaltselemente und Menüvarianten bereit. Sie verwendet Flux, VHS und Content Blocks. Optionale Erweiterungen wie News, Powermail, Mask und image_autoresize müssen gesondert auf Kompatibilität mit TYPO3 14.3 geprüft werden.

**Versionierung und Branches:** Die Dokumentation gilt für die TYPO3-14-Version der Extension unabhängig vom gewählten Branch. `v14-main` enthält die veröffentlichten Stände, `v14-dev` dient der Weiterentwicklung. Die tatsächlich enthaltene Extension-Version steht in `ext_emconf.php` und `composer.json`; die Änderungshistorie in `CHANGELOG.md`.

**Systemvoraussetzungen:** Benötigt werden TYPO3, PHP sowie die Erweiterungen Content Blocks, Flux und VHS. Die für den jeweiligen Stand gültigen Versionsanforderungen sind in `composer.json` und `ext_emconf.php` definiert.

## Anleitung
### Installation und Konfiguration
Um Zeitüberschreitungen bei der Installation zu vermeiden, sollten die benötigten Erweiterungen vorab installiert werden:
- `vhs`
- `flux`
- `content_blocks`

#### Installation per Git
Bei einer klassischen Installation kann die Extension im Extension-Verzeichnis des TYPO3-Projekts ausgecheckt werden (Verzeichnisstruktur abhängig von der Installationsart).

**Release-Zweig `v14-main`:**
```bash
git clone --branch v14-main https://github.com/Sofatraining/liepstypo3defaults.git
```

**Entwicklungszweig `v14-dev`:**
```bash
git clone --branch v14-dev https://github.com/Sofatraining/liepstypo3defaults.git
```

Für Composer-basierte Installationen gelten die Vorgaben des jeweiligen TYPO3-Projekts. Ein Git-Checkout ersetzt nicht die Installation der Abhängigkeiten.

#### TYPO3 14.3: Site Set aktivieren

Nach der Installation unter **Sites → Setup → Site-Konfiguration** das Set **LIEPS TYPO3 Defaults** (`liepsgmbh/liepstypo3defaults`) zur Site hinzufügen. Das Set lädt die vorhandenen `Configuration/TypoScript/setup.typoscript` und `constants.typoscript` automatisch. **Fluid Styled Content** wird durch die Set-Abhängigkeit eingebunden; das CSS-Set ist bei Bedarf zusätzlich auswählbar.

Die bisher angepassten Fluid-Styled-Content-Werte (Bildbreiten, Lightbox und Template-Pfade) werden in `Configuration/Sets/Main/settings.yaml` als Set-Defaults bereitgestellt. Eine Site kann diese über eigene Site Settings überschreiben.

**Kein statisches LIEPS-TypoScript-Template parallel einbinden.** Falls ein älterer `sys_template`-Datensatz übernommen wurde, dessen bisherige LIEPS-Einbindung entfernen und auf die Root-Template-Flags `Clear constants`/`Clear setup` achten. Diese können Site-Set-TypoScript löschen.

* Sprachdateien nach der Installation unter **Wartung → Sprachen verwalten → Alle aktualisieren** aktualisieren.  
* TYPO3 14 unterstützt die bisherige CSS-/JavaScript-Komprimierung und -Konkatenation im Frontend nicht mehr. `config.compressJs`, `config.compressCss`, `config.concatenateJs` und `config.concatenateCss` dürfen nicht mehr gesetzt werden (auch nicht auf `0`).
* Vorhandene minimierte CSS- und JavaScript-Dateien werden weiterhin über `page.includeCSS*` und `page.includeJS*` eingebunden. Die Optimierung erfolgt im Build-Prozess (siehe `Build/package.json`), nicht über TypoScript.
* Veraltete Konfigurationen wie `config.absRefPrefix`, `config.linkVars = L` und der `TSFE:id`-Fallback in `lib.dynamicContent` wurden für TYPO3 14 entfernt oder ersetzt.

#### Menüvariante auswählen (Site Settings)
Unter **Sites → Setup → Einstellungen (Site Settings)** in der Kategorie **LIEPS TYPO3 Defaults** die Menüvariante wählen:

- **Classic** (1)
- **Modal Fullscreen** (2)
- **OffCanvas von links** (3)

Die Einstellung `plugin.tx_liepstypo3defaults.settings.headerOption` bleibt als TypoScript-Konstante unter demselben Namen verwendbar. Die entsprechenden CSS- und JavaScript-Dateien werden durch TYPO3s `f:asset.css` und `f:asset.script` eingebunden; `v:asset.*` ist in VHS 8 nicht mehr verfügbar.

***

### EXT:Fluid Styled Content
- Das Set `typo3/fluid-styled-content` ist als Abhängigkeit des LIEPS-Site-Sets angegeben und wird von TYPO3 automatisch berücksichtigt.
- Das CSS-Set `Fluid Styled Content CSS` kann zusätzlich aktiviert werden.
- Template- und Partial-Überschreibungen liegen unter `Resources/Private/*/ContentElements/`.
***

### Flux-Templates
* Die Flux-Inhaltstemplates liegen unter `Resources/Private/Templates/Content/`; Seitentemplates unter `Resources/Private/Templates/Page/`.
* Der Flux-Provider für Seiten- und Inhaltstemplates wird durch die Extension registriert.
* Flux-Dokumentation: https://fluidtypo3.org/documentation/templating-manual/introduction.html
***

### EXT:News (optional)
```ini
[Template -> Enthält -> "News (news)" hinzufügen]   
``` 
* "News Styles Twitter Bootstrap V5 (news)" muss nicht mehr in die statischen Templates hinzugefügt werden
* Datumsformate und Linkbezeichnungen werden abhängig von der Spracheneinstellung in der Site-Config ausgegeben  
* Siteconfig (config.yaml) für sprechende URL's muss nach Konfiguration anpasst werden
* News-CSS liegt unter EXT:liepstypo3defaults/Resources/Public/Css/news-basic.css
***
  
### EXT:Powermail (optional)
* Anpassungen für "Add classes and CSS based on bootstrap (powermail)" vorgenommen 
```ini
[Template -> Enthält -> "Main Template (powermail)" hinzufügen]
[Template -> Enthält -> "Add classes and CSS based on bootstrap (powermail)" unter "Main Template (powermail)" hinzufügen]  
```  
***
  
### EXT:Mask (optional)
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
## Prüfpunkte für Integrationstests
- Flux 12 und VHS 8 einschließlich verschachtelter Inhalte und bestehender FlexForm-Daten in einer laufenden TYPO3-14.3-Installation prüfen.
- Content Blocks 2.x und CKEditor 5 praktisch testen.
- Fest codierte Asset-URLs, Installation und Darstellung vor einer Veröffentlichung testen.
