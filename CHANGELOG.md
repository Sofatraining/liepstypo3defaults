# Changelog – LIEPS TYPO3 Defaults

## v5.1.0 – TYPO3 14.3 LTS

### Korrektur: TYPO3-14-SelectItem im Backend-Layout-Filter
- In `FluxBackendLayoutItems` berücksichtigt der Auswahlfilter die von TYPO3 14 übergebenen `TYPO3\CMS\Core\Schema\Struct\SelectItem`-Objekte und liest deren Kennung über `getValue()` aus. Auch TCA-Einträge im Arrayformat werden weiterhin unterstützt.
- Dadurch wird der `TypeError` beim Öffnen der Seiteneigenschaften behoben, ohne die Layout-IDs, die Filterregeln oder die Kopplung von Backend- und Frontend-Layouts zu ändern.
- **Prüfhinweis:** Die TYPO3-14.3-Laufzeit und die tatsächliche Auswahl müssen nach dem Extension-Update und der Cache-Leerung im Backend geprüft werden.

### Flux-Provider-Auswahl auf TYPO3-Backend-Layouts anwenden
- Neues `Classes/Backend/FluxBackendLayoutItems.php` filtert nach der bestehenden TYPO3-Backend-Layout-Ermittlung die eigenen PageTS-Layouts anhand der Site-Konfiguration `flux_page_templates`.
- Beide Felder in den Seiteneigenschaften (`backend_layout` und `backend_layout_next_level`) verwenden den Filter über `Configuration/TCA/Overrides/pages.php`.
- Leere Flux-Template-Auswahl bedeutet unverändert: alle Backend-Layouts zulassen. Layouts anderer Erweiterungen und die TYPO3-Standardoptionen werden nicht entfernt.
- Die bestehenden Layout-IDs, Grid-/Spaltendefinitionen und die Frontend-Template-Zuordnung über `data = pagelayout` bleiben unverändert. Es werden keine bestehenden Seitendatensätze geändert.
- **Prüfhinweis:** Nach dem Extension-Update die TYPO3-Caches leeren und in TYPO3 14.3 prüfen, ob die Auswahl 010/020 in der Site-Konfiguration in beiden Feldern unter »Erscheinungsbild« nur die dazugehörigen eigenen Backend-Layouts anbietet und die Frontend-Layouts weiterhin wechseln. Bereits gespeicherte, danach nicht mehr erlaubte IDs bleiben in der Datenbank erhalten, sind aber nicht mehr als auswählbare Optionen sichtbar.

## v5.0.0 – TYPO3 14.3 LTS

### Schritt 14: Doppelte Flux-Page `Default/Default` entfernt (16.11.2026)
- Die beiden Dateien `Resources/Private/Templates/Page/Default.html` und `Resources/Private/Templates/Page/Default/Default.html` geprüft: Der Fluid-Code ist identisch; nur das explizite Anzeigelabel unterscheidet sich.
- Flux 12 findet und registriert wegen seiner rekursiven Page-Template-Suche beide Dateien als getrennte Seitenlayouts. Die verschachtelte Variante `Default/Default` wird nicht benötigt, um die reguläre Vorlage `Default` aufzulösen.
- `Resources/Private/Templates/Page/Default/Default.html` gelöscht; `Page/Default.html` und alle anderen zwölf Seitentemplates unverändert beibehalten. Im Git-Repository keine direkten Verweise auf die verschachtelte Variante gefunden.
- **Bestandsdaten-Hinweis:** Falls bei einer vorhandenen Website `Default/Default` explizit in `pages.tx_fed_page_controller_action` oder `pages.tx_fed_page_controller_action_sub` gespeichert ist, muss diese Seitenlayout-Zuordnung auf `Default` geändert werden. Die Website-Datenbank wurde nicht geprüft und wird nicht verändert.
- **Test offen:** Nach dem Update TYPO3-/Flux-Caches leeren und die Seite sowie die Site-Konfiguration erneut überprüfen; erwartet werden zwölf statt dreizehn Flux-Seitenlayouts.

### Schritt 13: Eigene Bezeichnungen für Flux-Inhaltselemente im Site-Konfigurator (16.11.2026)
- Im Site-Konfigurator unter **Flux-Provider → Verfügbare Inhaltselemente** werden die neun bestehenden Flux-Inhaltstypen künftig mit sprechenden Anzeigenamen dargestellt.
- Neue Bezeichnungen: `Sektion`, `2 Spalten-Element`, `3 Spalten-Element`, `4 Spalten-Element`, `Bootstrap Accordion`, `Bootstrap Carousel`, `Beispiel-Inhalt`, `Bootstrap Offcanvas` und `Bootstrap Tabs`.
- `Classes/Backend/FluxContentTypeItems.php` als gezielten Adapter für Flux 12 angelegt. Er verwendet weiterhin `SiteConfigurationProviderItems::processContentTypeItems()` und tauscht ausschließlich die Anzeigelabels der neun bekannten CType-Kennungen aus.
- Unter `Configuration/SiteConfiguration/Overrides/site.php` die `itemsProcFunc` für `flux_content_types` auf den Adapter umgestellt, ohne andere Flux-Site-Felder zu überschreiben.
- **Unverändert:** CType-Werte und ihre Schreibweise, bestehende Datensätze, Flux-Templates, FlexForms und die Funktion der optionalen Site-Filter.
- **Prüfung:** PHP-Syntax lokal geprüft; der Adapter wurde mit numerischen und assoziativen Auswahleinträgen sowie unbekannten CTypes getestet. Backend-Anzeige nach Extension-Update und Cache-Leerung noch zu prüfen.

### Schritt 12: Flux-Seitentemplates im Site-Konfigurator eindeutig beschriften (16.11.2026)
- Allen 13 Flux-Seitentemplates unter `Resources/Private/Templates/Page/` ein explizites `label`-Attribut am bestehenden `<flux:form id="standard">` zugewiesen. Beispiel: `<flux:form id="standard" label="Seitenlayout 010">`.
- Eindeutige Namen ohne „LIEPS“ vergeben: `Seitenlayout 010`, `020`, `030`, `110`, `111`, `120`, `121`, `130`, `131`, `Default`, `Default/Default`, `None` und `Standard`.
- Die bisher identische Anzeige `Default Page` im Reiter **Flux-Provider → Verfügbare Seitenlayouts/-templates** wird durch individuelle Bezeichnungen ersetzt.
- **Unverändert:** `flux:form`-IDs (`standard`), Dateipfade, Flux-FlexForm-Definitionen, Spalten, Backend-Filter und Frontend-Rendering. Eine leere Auswahl im Flux-Provider-Reiter erlaubt weiterhin alle verfügbaren Typen.
- **Test ausstehend:** TYPO3-Caches nach Aktualisierung leeren und die eindeutigen Namen im Site-Konfigurator kontrollieren.

### Schritt 11: Automatisch generierte Content-Blocks-Site-Sets im Backend ausblenden (16.11.2026)
- `Configuration/user.tsconfig` ergänzt. TYPO3 14.3 lädt diese Datei als globale User-TSconfig automatisch; eine PHP-Registrierung ist nicht notwendig.
- Mit `options.sites.hideSets := addToList(...)` alle zwölf automatisch erzeugten Site Sets der LIEPS-Content-Blocks und das Set `liepstypo3defaults/content-blocks-bundle` aus der Liste **Verfügbare Objekte** ausgeblendet.
- Das eigentliche Site Set `liepsgmbh/liepstypo3defaults` bleibt sichtbar und aktivierbar. Die ausgeblendeten Sets bleiben technisch vorhanden; bereits ausgewählte Sets werden weiterhin bei den aktivierten Objekten angezeigt.
- **Keine Änderungen** an Content-Block-Definitionen, CTypes, Datenbankfeldern, Templates oder der Site-Set-Registrierung. Da keine einzelnen Content-Block-Sets aktiviert werden müssen, bleibt die bisherige Sichtbarkeit der zwölf Inhaltselemente erhalten.
- **Offen:** Nach `git pull`, Leeren der TYPO3-Caches und erneutem Öffnen der Site-Konfiguration prüfen, ob die zwölf Einträge und das Bundle aus den verfügbaren Sets verschwunden sind.

### Schritt 10: Fehlende Beschriftung des Buttons-Content-Blocks (16.11.2026)
- Im TYPO3-14.3-Assistenten für neue Inhaltselemente wurden Titel und Beschreibung des Content Blocks `liepsgmbh/button` nicht angezeigt.
- In `ContentBlocks/ContentElements/button/language/labels.xlf` das widersprüchliche Attribut `target-language="de"` entfernt. Die Datei enthält ausschließlich englisch deklarierte `<source>`-Einträge und keine `<target>`-Übersetzungen; TYPO3 behandelt sie nun als Ausgangssprachdatei.
- Der Text `Button` und die Beschreibung sowie die Content-Block-Identität und die Feldkonfiguration bleiben unverändert.
- **Prüfhinweis:** Nach dem Extension-Update und der Cache-Leerung Beschriftung und Beschreibung im Backend-Assistenten kontrollieren.

### Schritt 9: Nicht auflösbare Meta-Konstanten im Frontend entfernt (16.11.2026)
- Nach erfolgreicher Korrektur des Seitentitels erzeugte `meta.typoscript` den HTML-Tag `<meta name="apple-mobile-web-app-capable" content="{$page.meta.apple-mobile-web-app-capable}">`, da die verwendete Konstante nicht definiert war.
- `page.meta.apple-mobile-web-app-capable` aus `Configuration/TypoScript/Setup/Page/meta.typoscript` entfernt. Ohne aktivierte iOS-Standalone-Web-App ist dieses Meta-Tag nicht erforderlich; es kann bei einem späteren PWA-Bedarf gezielt konfiguriert werden.
- Gleichzeitig die ebenfalls undefinierte Konstante `{$page.meta.compatible}` und den dazugehörigen veralteten `X-UA-Compatible`-Meta-Tag für Internet Explorer entfernt.
- Vorhandene SEO-, OpenGraph-, Robots-, Viewport-, Description-, Author- und Keywords-Einstellungen unverändert belassen.
- **Prüfhinweis:** Nach dem Extension-Update und der Cache-Leerung die HTML-Ausgabe im Frontend erneut prüfen; keine Änderungen an bestehenden Site Settings oder Datenbankdaten.

### Schritt 8: Titelgenerierung – TYPO3-14-USER-Callable-Freigabe (16.11.2026)
- Nach erfolgreichem Frontend-Rendering wurde der Seitentitel als `Oops, an error occurred! Request: … :: Dev v14` ausgegeben.
- Ursache: `page.headerData.10.10` ruft den eigenen `LiepsGmbH\Liepstypo3defaults\Seo\TitleTagResolver->resolve` als TypoScript-`USER`-Funktion auf. Seit TYPO3 14 verlangt dies ausdrücklich `#[\TYPO3\CMS\Core\Attribute\AsAllowedCallable]` (Breaking Change #108054); bislang fehlte das Attribut.
- `Classes/Seo/TitleTagResolver.php` um `use TYPO3\CMS\Core\Attribute\AsAllowedCallable;` und `#[AsAllowedCallable]` unmittelbar vor der Methode `resolve()` ergänzt.
- Sonstige Logik für News-/Event-Detailtitel und den Fallback auf `seo_title` / `title` unverändert; keine TypoScript-/Datenbankänderungen.
- **Prüfhinweis:** Nach dem Extension-Update und Leeren der TYPO3-Caches die HTML-`<title>`-Ausgabe im Frontend prüfen. Der konkrete Server-Request-Fehler wurde nicht anhand eines zugehörigen Logeintrags verifiziert; der fehlende Attributschutz ist durch den Source-Abgleich mit TYPO3 14.3.11 jedoch nachgewiesen.

### Schritt 7: Site Sets und erster TYPO3-14.3.11-Laufzeittest (16.11.2026)
- TYPO3 14.3.11 konnte die Extension laden und einen Flux-Page-Controller aufrufen; beim Rendern trat die `InvalidLayoutException` für Layout `Default` auf.
- Ein eigenes Site Set `liepsgmbh/liepstypo3defaults` unter `Configuration/Sets/Main/` eingeführt. Es bindet die vorhandenen TypoScript-Dateien ein und deklariert `typo3/fluid-styled-content` als Set-Abhängigkeit, statt dessen TypoScript direkt mehrfach zu importieren.
- Die bisherige Menüauswahl unter `plugin.tx_liepstypo3defaults.settings.headerOption` als Site Setting mit drei Varianten (Classic, Modal Fullscreen, OffCanvas von links) bereitgestellt; der bisherige TypoScript-Konstantenname bleibt erhalten.
- Die bestehenden Fluid-Styled-Content-Anpassungen (Template-Pfade, Bildgrößen und Lightbox-Konfiguration) als vererbbare Set-Defaults in `Configuration/Sets/Main/settings.yaml` übernommen.
- Die Flux-View-Pfade für die Page- und Content-Verzeichnisse ergänzt, damit die Page-Layouts (`Default`) und Header-/Footer-Partials beim Rendern über den Flux-Controller aufgelöst werden können.
- Selbstreferenzierende `<f:layout>`-Deklarationen in `Layouts/Page/Default.html`, `Layouts/Content/Content.html` und `Layouts/Content/Page.html` entfernt; die `Main`-Sektionen bleiben erhalten.
- `README.md` auf die Site-Set-Einbindung und die Menüauswahl über Site Settings aktualisiert. Das bisherige statische Template darf nicht zusätzlich eingebunden sein.
- **Offen:** TYPO3-14.3.11-Frontend nach Aktivierung des Sets, Cache-Leerung und Kontrolle der Root-Template-Clear-Flags erneut aufrufen. Erfolgreiches Rendering ist erst nach diesem Integrationstest bestätigt.

### Schritt 6: CKEditor 5 / RTE-Konfiguration für TYPO3 14.3
- `Configuration/RTE/Default.yaml` auf die CKEditor-5-Struktur migriert: `toolbar.items`, `style.definitions` (Lead), `heading.options` (Absatz, H1–H5, Pre) und `alignment.options` statt der alten CKEditor-4-Einstellungen.
- TYPO3-Core-Konfigurationen `Processing.yaml`, `Editor/Base.yaml` und `Editor/Plugins.yaml` importiert; die obsolete eigene `Configuration/RTE/Editor/Base.yaml` entfernt.
- RTE-Höhe 450 px, eigene Editor-CSS, Tabellenwerkzeuge sowie Wort-/Zeichenzählung mittels CKEditor-5-`WordCount` beibehalten bzw. ergänzt. TYPO3-Link-/Whitespace-Plugins bleiben über den Core-Import verfügbar.
- Vorhandene Ausrichtungsklassen `text-left`, `text-center`, `text-right` und `text-justify` bewusst erhalten, damit bestehende Texte nicht unmittelbar auf neue Klassen umgestellt werden.
- `Resources/Public/Css/rte.css` für CKEditor 5 aktualisiert (`:root` und `p.lead`), `.cke_*`-Selektoren und IE-spezifische Altlasten entfernt; übrige Inhaltsstile weitergeführt.
- Keine pauschale Freigabe beliebiger HTML-Klassen oder `data-*`-Attribute wie im früheren `extraAllowedContent`; etwaige Sonderformatierungen müssen gezielt geprüft werden.
- `ext_localconf.php` und `Configuration/TsConfig/Page/RTE.tsconfig` bleiben unverändert. **Offen:** RTE-Laufzeittest unter TYPO3 14.3 inklusive TYPO3-Linkbrowser, Wortzählung und Prüfung bestehender HTML-Inhalte vor und nach dem Speichern.

### Schritt 5: Content Blocks 2.4.10 – statische Schema-Bereinigung
- Alle zwölf Content-Blocks-Konfigurationen mit den Feldoptionen des offiziellen 2.4.10-JSON-Schemas abgeglichen; zehn `config.yaml`-Dateien korrigiert, `carouselimage` und `downloads` unverändert.
- `button`: Vier Checkbox-Defaults von `false` auf den schema-konformen Integer `0` gesetzt; `required: true` und `min: 1` bei der Collection `button_items` durch `minitems: 1` ersetzt.
- `timeline`: Bei Collection `timeline_events` `required: true` und `min: 1` zu `minitems: 1` zusammengeführt.
- Dateifelder: `allowedExtensions` in `gallery` und `testimonials` zu `allowed`, `maxItems` in `modal`, `scrollspy` und `testimonials` zu `maxitems` geändert; `teaser.image` mit `minitems: 1` statt `required: true` abgesichert; ungültiges `minitems: 0` in `modalautostart` entfernt (Datei bleibt optional).
- `card`: Nicht unterstütztes `max: 50` aus dem Feldtyp `Email` entfernt. `stoerer`: Nicht unterstütztes `maxCharacters` zu `max` geändert und den wiederverwendeten `bodytext` passend als `Textarea` statt `Text` deklariert.
- Inhaltstypen, Feld-/Collection-Identifikatoren, Präfixregeln und Relationseinstellungen nicht verändert; keine Datenbankmigration und keine Anpassung von Fluid-Templates.
- **Prüfung:** Statischer Abgleich der verwendeten Feldoptionen und primitiven Werttypen gegen das 2.4.10-Schema ohne verbliebene Befunde. Ein vollständiges `content-blocks:lint` sowie Frontend-/Backend- und Bestandsdaten-Tests sind erst in einer TYPO3-14.3-Testinstallation möglich; es besteht noch keine Laufzeitfreigabe.

### Schritt 4: Flux 12 / VHS 8 – statische Template-Prüfung
- Fluid-/Flux-Syntaxfehler in `Resources/Private/Templates/Content/106-Columns-25-25-25-25.html` behoben: Bei `settings.section.rowClasses` wurde `default="""` zu `default=""` korrigiert.
- Vorhandene Flux-Grid-Kennungen, Spaltennummern, FlexForm-Feldnamen und Renderbereiche unverändert belassen, um Bestandsdaten nicht ohne Migrationstest zu beeinflussen.
- Statisch geprüft: verwendete Flux-/VHS-ViewHelper sind in Flux 12.0.2 bzw. VHS 8.0.0 vorhanden; die Formel für verschachtelte `colPos`-Werte ist gegenüber Flux 11.1.4 unverändert.
- **Noch offen (späterer TYPO3-14.3-Integrationstest):** Registrierung/Instanziierung eigener Flux-Controller einschließlich Dependency Injection, Frontend- und Backend-Rendering, vorhandene FlexForms, verschachtelte Inhalte, Seitenlayouts, Übersetzungen und Workspaces. Für diese Punkte wird aktuell keine Funktionsfreigabe behauptet.

### Schritt 3: TypoScript-Bereinigung für TYPO3 14
- Veraltete `config`-Optionen aus `constants.typoscript` und `Setup/Config/config.typoscript` entfernt: `absRefPrefix`, `uniqueLinkVars`, `linkVars = L`, `prefixLocalAnchors`, `renderCharset`, `metaCharset`, `frontend_editing`.
- Zusätzlich aus `Setup/Config/config.typoscript` entfernt: `noScaleUp`, `compressJs`, `compressCss`, `concatenateJs`, `concatenateCss`. CSS-/JavaScript-Build findet außerhalb des TYPO3-Runtimes statt.
- `TSFE:id` in `Helper/DynamicContent.typoscript` durch `page:uid` ersetzt, um die aktuelle Seiten-UID über die TYPO3-14-getText-API zu beziehen.
- Veraltete, auskommentierte `disableCompression`- und `excludeFromConcatenation`-Optionen aus `Setup/Page/page.typoscript` entfernt; die aktiven CSS-/JS-Einbindungen wurden nicht verändert.
- `README.md` an TYPO3 14.3, den Entwicklungsstand, VHS 8 und entfallene CSS-/JS-Komprimierungsoptionen angepasst.

### Schritt 2: VHS-8-Asset-Migration
- Sechs entfernte `v:asset.style`- und `v:asset.script`-Aufrufe in den Page-Header-Partials `Header-classic-bs5.html`, `Header-modal-full-01.html` und `Header-canvas-from-left-01.html` durch TYPO3s `f:asset.css` / `f:asset.script` ersetzt.
- Eindeutige Asset-Kennungen je Navigationsvariante; vorhandene CSS-/JS-Dateien bleiben unverändert.

### Schritt 1: Versionsnummer und Abhängigkeiten
- Version auf **5.0.0** gesetzt (`composer.json`, `ext_emconf.php`; `Build/package.json` war bereits auf 5.0.0).
- Composer-Mindestanforderungen: PHP `^8.3`, TYPO3 `^14.3.7`, Content Blocks `^2.4.10`, Flux `^12.0.2` und VHS `^8.0.0`.
- Abhängigkeiten in `ext_emconf.php` entsprechend abgeglichen. Die historische Version 4.x bleibt dem TYPO3-13-Zweig zugeordnet.

**Hinweis zu den Prüfungen:** Die in den Schritten genannten Prüfstände und offenen Tests dokumentieren den Kenntnisstand zum Zeitpunkt der jeweiligen Änderung. Sie beschreiben keinen aktuellen Freigabestatus und gelten unabhängig vom verwendeten Git-Branch.

---

## TYPO3 13.4 LTS – Version 4.x

### v4.0.7
- jQuery auf 4.0.0, Font Awesome auf 7.2 und Bootstrap auf 5.3.8 aktualisiert (historischer Changelog-Eintrag).
- Backend-Footer der Content Blocks um zusätzliche Informationen ergänzt.
- Fehlerbehebungen und Codebereinigung.

### v4.0.6
- Flux-Inhaltselemente Testimonials, Galerie, Scrollspy und Modalbox auf Content Blocks migriert.
- Fehlerbehebungen und Codebereinigung.

### v4.0.5
- Kompatibilität mit Flux-Versionen oberhalb 11.0.3 angepasst.
- Flux-Inhaltselemente Störer, Carousel-Image, Downloads und Autostart-Modalbox auf Content Blocks migriert.
- Fehlerbehebungen und Codebereinigung.

### v4.0.4
- Weitere Flux-Inhaltselemente (Ansprechpartner/Card, Timeline und Teaser) auf Content Blocks migriert.
- Neue Icons ergänzt.

### v4.0.3
- Build-System modernisiert.
- HTML-`<a>`-Elemente in den Menütemplates durch Fluid-`f:link`-ViewHelper ersetzt.

### v4.0.2
- Veralteten Aufruf `ExtensionManagementUtility::addPageTSConfig()` aus `ext_localconf.php` entfernt und `Configuration/page.tsconfig` ergänzt.
- Veraltete `INCLUDE_TYPOSCRIPT`-Anweisungen durch `@import` ersetzt.
- Carousel, `meta.typoscript` und `locallang.xlf` korrigiert.
- `ParentPageTitleViewHelper.php` hinzugefügt; `RemoveSpacesVieHelper.php` entfernt und `NormalizePhoneViewHelper.php` ergänzt.
- Historisches auskommentiertes Beispiel für ein Carousel-Vorschaubild:

```html
<f:comment><flux:field.file name="iconImage" allowed="jpg,png,svg" showThumbnails="1" minItems="0" maxItems="1" useFalRelation="1" internalType="file_reference" label="Vorschaubild (nur wenn Art des Paginators -> Bild)" /></f:comment>
```

### v4.0.1
- Kleinere Fehlerbehebungen.

### v4.0.0
- Unterstützung für TYPO3 13.4 eingeführt.
- Mindestanforderungen: Flux 11.0 und VHS 7.1.
- Neue `TYPO3_CONF_VARS`-Konfiguration.
- Neue Content-Blocks-Struktur für Ansprechpartner; weitere Migrationen angekündigt.

---

## TYPO3 12.4 / 11.5 LTS – Version 3.x

### v3.0.5
- Migration der Flux-Inhaltselemente zu Content Blocks mit dem Ansprechpartner-Element begonnen.
- Deaktivierung einzelner Tabs und Accordion-Panels in den Flux-Templates ermöglicht.
- Benutzerdefinierte Scrollbar (CSS) ergänzt.
- Font Awesome auf 6.7.2 aktualisiert.

### v3.0.4
- `composer.json`, `ext_emconf.php`, `ext_localconf.php` und `PageTitleProvider.php` aktualisiert.

### v3.0.3
- Inhaltselement Störer (`Stoerer.html`) ergänzt.
- Font Awesome auf 6.5.2 und Bootstrap auf 5.3.3 aktualisiert.
- Fehlerbehebungen.

### v3.0.2
- Fehlerbehebungen.

### v3.0.1
- TypoScript-Bibliothek für den Site-Titel hinzugefügt (Site-Konfiguration → Sprache → Website-Titel).
- FAQ-Inhaltselement ergänzt.
- Font Awesome auf 6.5.1 aktualisiert.
- Fehlerbehebungen.

### v3.0.0
- Unterstützung für TYPO3 12.4 eingeführt.
- Mindestens Flux 10.0.7 vorausgesetzt (Page-Template-Fehler bis 10.0.6).
- Bootstrap auf 5.3.2, jQuery auf 3.7.1 und Font Awesome auf 6.4.2 aktualisiert.
- Feldbezeichnungen in den Spaltenelementen angepasst.

---

## TYPO3 11.5 LTS – Version 2.x

### v2.0.9
- Spaltenelemente überarbeitet: Spaltenbreiten für jede Spalte und alle Viewports individuell einstellbar.
- Bootstrap auf 5.3.0, jQuery auf 3.7.0 und Font Awesome Free auf 6.4.0 aktualisiert.

### v2.0.8
- Timeline-Element ergänzt.
- Abhängigkeiten in `ext_emconf.php` bereinigt.
- Autostart-Modalbox mit Cookie-Steuerung ergänzt (nach dem Schließen für fünf Minuten deaktiviert).
- Weitere Menüvarianten und Umschaltung über TypoScript-Konstanten ergänzt.

### v2.0.7
- Positionierung für Button-Elemente ergänzt.
- TCA-Header-Bereich bei benutzerdefinierten Inhaltselementen deaktiviert.
- Von `bootstrap.min.js` auf `bootstrap.bundle.min.js` umgestellt.
- Kleinere Fehlerbehebungen.

### v2.0.6
- Bildergalerie (Zeilenlayout) und Fullscreen-Menü ergänzt.
- Bootstrap auf 5.2.3 und Font Awesome auf 6.2.1 aktualisiert.

### v2.0.5
- Fehler in `ext_emconf.php` behoben.

### v2.0.4
- Kleinere Fehlerbehebungen.
- AP-Box ergänzt.
- TCEFORM für `tt_content` sowie das Fluid-Styled-Content-Partial `Header/All.html` überschrieben.

### v2.0.3
- Responsive Bildquellen (`srcset`) und WebP-Unterstützung im Fluid-Partial `Media/Rendering/Image.html` ergänzt.

### v2.0.2
- Powermail-Templates korrigiert.

### v2.0.1
- Unterstützung für TYPO3 11.5 LTS eingeführt.

---

## TYPO3 10.4 LTS – Version 1.x

### v1.0.11
- CSS-Klassen für Reihen und Spalten in Containerelementen konfigurierbar gemacht.

### v1.0.10
- Neue Bootstrap-Navigation und Flux-Button-Template ergänzt.
- Pfad zum Hintergrundbild des Section-Elements korrigiert.
- Neuen PageTitleProvider hinzugefügt.

### v1.0.9
- `lib.dynamicContentSlide` ergänzt.
- Flux-Template für OffCanvas ergänzt.
- Option `container-fluid` und Hintergrundbild für das Section-Template hinzugefügt.
- Fehler im Page-Template `None.html` behoben; weitere Feinabstimmungen.

### v1.0.8
- Flux-Templates für Teaser, Accordion, Tabs, Carousel und Carousel-Image ergänzt.
- Fehler beim Autoloading der Klassen behoben.

### v1.0.7
- Bootstrap-5-Darstellung für News korrigiert.
- Font Awesome 6 integriert.

### v1.0.6
- Breadcrumb-Navigation mit MenuProcessor ergänzt.
- Bootstrap-5-Darstellung für News eingeführt.
- Codebereinigung und Fehlerbehebungen.

### v1.0.5
- Dateistruktur für TypoScript überarbeitet.
- VHS und Flux integriert; Flux-Templates ergänzt.

### v1.0.4
- jQuery Magnific Popup integriert.
- Templates und Partials für Fluid Styled Content ergänzt.
- Codebereinigung und Fehlerbehebungen.

### v1.0.3
- `setup.typoscript`, `constants.typoscript` und die Template-Pfade für News und Powermail angepasst.

### v1.0.2
- Backend-Layouts, Templates und RTE erweitert bzw. angepasst.
- Zusätzliche Extensions wie image_autoresize, Mask, Powermail und News berücksichtigt.
- Fehlerbehebungen.

### v1.0.1
- `constants.typoscript` und `setup.typoscript` an die LIEPS-Standards angepasst.

### v1.0.0
- Erste Veröffentlichung auf Basis eines Sitepackages von [sitepackagebuilder.com](https://www.sitepackagebuilder.com/).

---

## Historische Planung (ältere To-do-Liste)

Die folgenden Punkte stammen aus einer früheren Planung. Sie sind **kein verifizierter aktueller Arbeitsstand** der TYPO3-14-Migration.

- **TYPO3-13-Optimierung:** Einsatz der AssetCollector-API statt VHS-Assets (für die drei Navigations-Partials in v5.0.0 umgesetzt), Dependency Injection statt `ExtensionUtility`, Migration von Hooks zu Events und Optimierung des Caching-Frameworks.
- **Bootstrap 5:** Moderne Layouts und Komponenten sowie zusätzliche CSS-Variablen für Theming.
- **Dokumentation:** PHPDoc verbessern, README aktualisieren, Changelog strukturieren und Content Blocks detaillierter dokumentieren.
- **Sicherheit und Performance:** Content-Security-Policy, Subresource Integrity für externe Ressourcen, Lazy Loading für Bilder und iFrames sowie HTTP/2-Optimierung.
- **Barrierefreiheit:** WCAG 2.1 AA, Tastaturnavigation, ARIA-Attribute und Farbkontraste verbessern.

Die Modernisierung des Build-Systems wurde bereits in **v4.0.3** dokumentiert.
