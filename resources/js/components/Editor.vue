<script>
    export default {
        props: {
            editor: {
                default: null,
                type: Object
            },
            value: {
                default: "",
                type: String
            }
        },

        watch: {
            editor: {
                immediate: true,
                handler(editor) {
                    if (!editor || !editor.element) return;

                    this.editor.setContent(this.value);
                    this.editor.on("update", ({ getHTML }) => {
                        this.$emit("input", getHTML());
                    });

                    this.$nextTick(() => {
                        this.$el.appendChild(editor.element.firstChild);
                        editor.setParentComponent(this);
                    });
                }
            },
            value: {
                handler(value) {
                    this.editor.setContent(value);
                }
            }
        },

        render(createElement) {
            return createElement("div");
        },

        beforeDestroy() {
            this.editor.element = this.$el;
        }
    };
</script>
