# UD Block: Projekt verknüpfen

Ein Block zur Verknüpfung von Magazin-Beiträgen mit einem Projekt.
Die Auswahl erfolgt im Editor über ein Panel, die Ausgabe erfolgt im Inhalt über einen Block.


## Funktionen

- Verknüpft einen Magazin-Beitrag (Post Type `post`) mit einem Projekt (Post Type `projekt`)
- Auswahl des Projekts über ein Editor-Panel in der Dokument-Seitenleiste
- Speicherung der Verknüpfung als Post Meta (`ud_projekt_verknuepfen`)
- Ausgabe des verknüpften Projekts über einen Block im Inhalt
- Kompatibel mit **Full Site Editing (FSE)**


## Voraussetzungen

- Custom Post Type `projekt` muss vorhanden sein
- Projekte müssen über die REST API verfügbar sein (`show_in_rest: true`)
- Block muss im Beitrag verwendet werden, damit die Verknüpfung im Frontend sichtbar ist


## Funktionsweise

Die Verknüpfung eines Projekts erfolgt nicht über Block-Attribute, sondern über ein zentrales Post Meta-Feld.
Dadurch kann der Block flexibel im Inhalt platziert werden, während die Auswahl global für den gesamten Beitrag gilt.


## Screenshots

![Frontend-Ansicht](./assets/ud-projekt_verknuepfen.png)
*Darstellung der Projektverknüpfung im Frontend mit Icon und Titel.*


## Autor

[ulrich.digital gmbh](https://ulrich.digital)


## Lizenz

GPL v2 or later
[https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)