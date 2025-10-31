import { __ } from "@wordpress/i18n";
import { useBlockProps, RichText } from "@wordpress/block-editor";
import ServerSideRender from "@wordpress/server-side-render";
import metadata from "../../block.json";

export default function Edit({ attributes, setAttributes, context }) {
    const { heading = "" } = attributes;
    const blockProps = useBlockProps();

    // Template-Editor → nur statische Ausgabe
    if (!context?.postId) {
        return (
            <div {...blockProps}>
                <p>{__("Gibt Projektlink aus (Frontend)", "ud-projekt-verknuepfen")}</p>
            </div>
        );
    }

    // Beitrags-Editor → editierbare Überschrift + Vorschau
    return (
        <div {...blockProps}>
            <RichText
                tagName="h2"
                placeholder={__("Überschrift", "ud-projekt-verknuepfen")}
                value={heading}
                onChange={(val) => setAttributes({ heading: val })}
                allowedFormats={[]}
            />

            <ServerSideRender block={metadata.name} attributes={attributes} />
        </div>
    );
}
