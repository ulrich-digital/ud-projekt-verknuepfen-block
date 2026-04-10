const el = wp.element.createElement;
const { registerPlugin } = wp.plugins;
const { PluginDocumentSettingPanel } = wp.editPost;
const { SelectControl, Spinner } = wp.components;
const { useSelect, useDispatch } = wp.data;
const { useState, useEffect } = wp.element;

registerPlugin('ud-projekt-verknuepfen-panel', {
    render: function () {
        const { editPost } = useDispatch('core/editor');

        const postType = useSelect(
            (select) => select('core/editor').getCurrentPostType(),
            []
        );
        const meta = useSelect(
            (select) => select('core/editor').getEditedPostAttribute('meta') || {},
            []
        );

        const [projects, setProjects] = useState([]);
        const [loading, setLoading] = useState(true);
/*
        useEffect(function () {
            wp.apiFetch({ path: '/wp/v2/projekt?per_page=100' })
                .then(function (posts) {
                    const options = [{ label: '– kein Projekt –', value: 0 }];

                    posts.forEach(function (post) {
                        options.push({
                            label: post?.title?.rendered || '(Ohne Titel)',
                            value: post.id,
                        });
                    });

                    setProjects(options);
                    setLoading(false);
                })
                .catch(function () {
                    setProjects([{ label: 'Keine Projekte verfügbar', value: 0 }]);
                    setLoading(false);
                });
        }, []);
*/
useEffect(function () {
    wp.apiFetch({ path: "/wp/v2/projekt?per_page=100" })
        .then(function (posts) {
            console.log("DEBUG Projekte API:", posts);

            if (!Array.isArray(posts)) {
                throw new Error("API-Antwort ist kein Array");
            }

            const options = [{ label: "– kein Projekt –", value: 0 }];

            posts.forEach(function (p) {
                options.push({
                    label: p?.title?.rendered || `(ohne Titel #${p.id})`,
                    value: p.id || 0,
                });
            });

            setProjects(options);
            setLoading(false);
        })
        .catch(function (error) {
            console.error("DEBUG Projekt-API Fehler:", error);
            setProjects([{ label: "Keine Projekte verfügbar", value: 0 }]);
            setLoading(false);
        });
}, []);

        if (postType !== 'post' || typeof meta.ud_projekt_verknuepfen === 'undefined') {
            return el(
                PluginDocumentSettingPanel,
                {
                    name: 'ud-projekt-verknuepfen-panel',
                    title: 'Projekt-Verknüpfung',
                    initialOpen: true,
                },
                el('p', {}, 'Projekt-Verknüpfung ist nur bei Beiträgen verfügbar.')
            );
        }

        return el(
            PluginDocumentSettingPanel,
            {
                name: 'ud-projekt-verknuepfen-panel',
                title: 'Projekt-Verknüpfung',
                initialOpen: true,
            },
            loading
                ? el(Spinner, {})
                : el(SelectControl, {
                      __next40pxDefaultSize: true,
                      __nextHasNoMarginBottom: true,
                      label: 'Projekt wählen',
                      value: meta.ud_projekt_verknuepfen ?? 0,
                      options: projects,
                      onChange: function (value) {
                          editPost({
                              meta: {
                                  ...meta,
                                  ud_projekt_verknuepfen: parseInt(value, 10) || 0,
                              },
                          });
                      },
                  })
        );
    },
});
