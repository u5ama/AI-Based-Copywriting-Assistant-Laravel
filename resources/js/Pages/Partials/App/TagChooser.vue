<script>
    /* eslint-disable */
    const validators = {
        email: new RegExp(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        ),
        url: new RegExp(
            /^(https?|ftp|rmtp|mms):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i
        ),
        text: new RegExp(/^[a-zA-Z]+$/),
        digits: new RegExp(/^[\d() \.\:\-\+#]+$/),
        isodate: new RegExp(
            /^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/
        )
    };
    /* eslint-enable */

    export default {
        name: "tag-chooser",

        props: {
            value: {
                type: Array,
                default: () => []
            },
            placeholder: {
                type: String,
                default: ""
            },
            readOnly: {
                type: Boolean,
                default: false
            },
            validate: {
                type: String,
                default: ""
            },
            addTagOnKeys: {
                type: Array,
                default: function() {
                    return [
                        13, // Return
                        188, // Comma ','
                        9 // Tab
                    ];
                }
            },
            addTagOnBlur: {
                type: Boolean,
                default: false
            },
            limit: {
                type: Number,
                default: -1
            },
            allowDuplicates: {
                type: Boolean,
                default: false
            },
            beforeAdding: {
                type: Function
            }
        },

        data() {
            return {
                newTag: "",
                innerTags: [...this.value],
                isInputActive: false
            };
        },

        computed: {
            isLimit: function() {
                return this.limit > 0 && Number(this.limit) === this.innerTags.length;
            }
        },

        watch: {
            value() {
                this.innerTags = [...this.value];
            }
        },

        methods: {
            focusNewTag() {
                if (this.readOnly || !this.$el.querySelector(".new-tag")) {
                    return;
                }
                this.$el.querySelector(".new-tag").focus();
            },

            handleInputFocus() {
                this.isInputActive = true;
            },

            handleInputBlur(e) {
                this.isInputActive = false;
                this.addNew(e);
            },

            async addNew(e) {
                const keyShouldAddTag = e
                    ? this.addTagOnKeys.indexOf(e.keyCode) !== -1
                    : true;

                const typeIsNotBlur = e && e.type !== "blur";

                if (
                    (!keyShouldAddTag && (typeIsNotBlur || !this.addTagOnBlur)) ||
                    this.isLimit
                ) {
                    return;
                }

                const tag = this.beforeAdding
                    ? await this.beforeAdding(this.newTag)
                    : this.newTag;

                const isValid = await this.validateIfNeeded(tag);

                if (
                    tag &&
                    isValid &&
                    (this.allowDuplicates || this.innerTags.indexOf(tag) === -1)
                ) {
                    this.innerTags.push(tag);
                    this.newTag = "";
                    this.tagChange();

                    e && e.preventDefault();
                }
            },

            validateIfNeeded(tagValue) {
                return true;
            },

            remove(index) {
                this.innerTags.splice(index, 1);
                this.tagChange();
            },

            removeLastTag() {
                if (this.newTag) {
                    return;
                }
                this.innerTags.pop();
                this.tagChange();
            },

            tagChange() {
                this.$emit("update:tags", this.innerTags);
                this.$emit("input", this.innerTags);
            }
        }
    };
</script>

<template>
    <div
        @click="focusNewTag()"
        :class="{
      'read-only': readOnly,
      'vue-input-tag-wrapper--active': isInputActive
    }" class="vue-input-tag-wrapper" style="padding: 0px;">
        <div class="inline-block m-1" v-for="(tag, index) in innerTags" :key="index" style="margin: 1.4px !important;display: flex;justify-content: center;align-items: center;font-size: 17px;">
            <div class="flex items-center " style="gap: 9px;padding: 8px;background-color: white;border: 1px solid #fc6501;">
                <div>
                    <span class="text-12 text-brand"> {{ tag }} </span>
                </div>
                <div v-if="!readOnly" @click.prevent.stop="remove(index)" style="margin-top: 7px;">
                    <img style="margin-top: -8px; color: #ff6b6b;" src="/assets/admin/images/close-icon-w.svg" alt="" class="w-15 h-15 cursor-pointer" />
                </div>
            </div>
        </div>
        <input type="text"
               ref="inputtag"
               v-if="!readOnly && !isLimit"
               :placeholder="placeholder"
               v-model="newTag"
               v-on:keydown.delete.stop="removeLastTag"
               v-on:keydown="addNew"
               v-on:blur="handleInputBlur"
               v-on:focus="handleInputFocus"
               style="border: none"
               class="text-13 tag-ip-box"
        />

    </div>
</template>

<style>
    .tag-ip-box:focus {
        outline: none;
        box-shadow: none;
        border: none;
    }

    .vue-input-tag-wrapper {
        background-color: #fff;
        border: 1px solid #ccc;
        overflow: hidden;
        padding-left: 4px;
        padding-top: 4px;
        cursor: text;
        text-align: left;
        -webkit-appearance: textfield;
        display: flex;
        flex-wrap: wrap;
    }

    .vue-input-tag-wrapper .input-tag {
        background-color: #cde69c;
        border-radius: 2px;
        border: 1px solid #a5d24a;
        color: #638421;
        display: inline-block;
        font-size: 13px;
        font-weight: 400;
        margin-bottom: 4px;
        margin-right: 4px;
        padding: 3px;
    }

    .vue-input-tag-wrapper .input-tag .remove {
        cursor: pointer;
        font-weight: bold;
        color: #638421;
    }

    .vue-input-tag-wrapper .input-tag .remove:hover {
        text-decoration: none;
    }

    .vue-input-tag-wrapper .input-tag .remove:empty::before {
        content: " x";
    }

    .vue-input-tag-wrapper .new-tag {
        background: transparent;
        border: 0;
        color: #777;
        font-size: 13px;
        font-weight: 400;
        margin-bottom: 6px;
        margin-top: 1px;
        outline: none;
        padding: 4px;
        padding-left: 0;
        flex-grow: 1;
    }

    .vue-input-tag-wrapper.read-only {
        cursor: default;
    }
</style>
