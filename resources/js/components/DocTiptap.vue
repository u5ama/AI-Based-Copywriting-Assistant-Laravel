<template>
    <div class="container-fluid mt-3 ">
        <div class="row">
            <div class="col-lg-3">
                <div>
                    <b-alert
                        :show="dismissCountDown"
                        dismissible
                        variant="danger"
                        @dismissed="dismissCountDown=0"
                        @dismiss-count-down="countDownChanged"
                    >
                        Please fill the form below
                    </b-alert>
                </div>
                <form action="google-ad" id="add_form" enctype="multipart/form-data">

                    <div class="form-group">
                        <span class="btm-char-count"><span class="brand-remaining-count">0</span><span>/80</span></span>
                        <label >Title</label>
                        <input type="hidden" name="category" value="">
                        <input type="text"
                               id="brand-remaining"
                               maxlength="80"
                               name="Company"
                               class="ctext form-control brand-remaining"
                               v-model="item.titleinput"
                               value="">
                        <span class="error" id="Company_error"></span>
                    </div>
                    <div class="form-group">
                        <span class="btm-char-count"><span class="description-remaining-count">0</span><span>/400</span></span>
                        <label for="company">Content description/brief</label>
                        <textarea type="text"
                                  name="CompanyDescription"
                                  maxlength="400"
                                  id="company"
                                  rows="3"
                                  v-model="item.contenttextarea"
                                  class="form-control description-remaining"></textarea>
                        <span class="error" id="CompanyDescription_error"></span>
                    </div>
                    <div class="form-group">
                        <div  class='tag-input'>
                            <div   v-for='(tag, index) in item.tags' :key='tag' class='tag-input__tag'  >
                                <div v-model="item.tags">
                                    <span @click='removeTag(index)'>x</span>
                                    {{ tag }}
                                </div>

                            </div>
                    </div>
                        <div class="form-group">
                            <input
                                type='text'
                                placeholder="Keywords (optional)"
                                class='tag-input__text form-control orm-control description-remaining keywords-input'
                                @keydown.enter='addTag'
                                @keydown.188='addTag'
                            />
                        </div>
                        </div>

                    <div class="form-group language mt-3">
                        <label >Language</label>
                        <input type="text"
                               class="form-control orm-control description-remaining"
                               id="language"
                               v-model="item.language"
                               aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label >Output Length</label>
                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div  v-for="size in item.sizes" :key="size.id">
                                <button v-on:click="makeRed(size.id)" :class="{'red': isActive == size.id}" type="button" class="btn btn-secondary mr-2 rounded bg-white border-0 text-dark outputs-length-button border-box"
                                        v-model="item.message"
                                        @click="item.message = size.info">
                                    {{size.name}}
                                </button>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="submit_btn" class="btn btn-secondary cancel-button mdl-btn mb-3" data-dismiss="modal" @click="save">Submit</button>
                </form>
            </div>
            <div class="col-lg-9">
                <div>

                    <div class="tiptap-editor" v-if="editor">
                        <button @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
                            bold
                        </button>
                        <button @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
                            italic
                        </button>
                        <button @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
                            strike
                        </button>
                        <button @click="editor.chain().focus().toggleCode().run()" :class="{ 'is-active': editor.isActive('code') }">
                            code
                        </button>
                        <button @click="editor.chain().focus().unsetAllMarks().run()">
                            clear marks
                        </button>
                        <button @click="editor.chain().focus().clearNodes().run()">
                            clear nodes
                        </button>
                        <button @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }">
                            paragraph
                        </button>
                        <button @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }">
                            h1
                        </button>
                        <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }">
                            h2
                        </button>
                        <button @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }">
                            h3
                        </button>
                        <button @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }">
                            h4
                        </button>
                        <button @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }">
                            h5
                        </button>
                        <button @click="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }">
                            h6
                        </button>
                        <button @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }">
                            bullet list
                        </button>
                        <button @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }">
                            ordered list
                        </button>
                        <button @click="editor.chain().focus().toggleCodeBlock().run()" :class="{ 'is-active': editor.isActive('codeBlock') }">
                            code block
                        </button>
                        <button @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }">
                            blockquote
                        </button>
                        <button @click="editor.chain().focus().setHorizontalRule().run()">
                            horizontal rule
                        </button>
                        <button @click="editor.chain().focus().setHardBreak().run()">
                            hard break
                        </button>
                        <button @click="editor.chain().focus().undo().run()">
                            undo
                        </button>
                        <button @click="editor.chain().focus().redo().run()">
                            redo
                        </button>
                    </div>
                </div>
                <div>
                    <editor-content v-model="item.getHTML" :editor="editor" class="editor-style"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Editor, EditorContent } from '@tiptap/vue-2'
    import StarterKit from '@tiptap/starter-kit'

    export default {
        components: {
            EditorContent,
        },
        data() {
            return {
                dismissSecs: 5,
                dismissCountDown: 0,
                isActive: 0,
                content: '<p> please write something</p>',
                editor: null,
                lists:[],
                users: {},
                item:{
                    titleinput:"",
                    contenttextarea:"",
                    language:"",
                    tags: [],
                    message: undefined,
                    getHTML:'',
                    sizes : [
                        {
                            id: 1,
                            info: "S",
                            name: "S"
                        },
                        {
                            id: 2,
                            info: "M",
                            name: "M"
                        },
                        {
                            id: 3,
                            info:"L",
                            name: "L"
                        }
                    ],

                },
            }
        },
        watch: {
            getHTML() {
                console.log(this.editor.getHTML());
            },
            modelValue(value) {
                // HTML
                const isSame = this.editor.getHTML() === value
                if (isSame) {
                    return
                }
                this.editor.commands.setContent(value, false)
            },
        },
        mounted() {
            this.getUser();
            //this.editor.commands.setContent(value, false)
            this.editor = new Editor({
                extensions: [
                    StarterKit,
                ],
                content: this.content,
                onUpdate: () => {
                    console.log( this.editor.getHTML())
                    this.item.getHTML =  this.editor.getHTML();
                },
            })
        },
        beforeUnmount() {
            this.editor.destroy()
        },

        methods:{
            countDownChanged(dismissCountDown) {
                this.dismissCountDown = dismissCountDown
            },
            showAlert() {
                this.dismissCountDown = this.dismissSecs
            },
            makeRed(el) {
                this.isActive = el;
            },
            getUser(){
                axios.get('/show')
                    .then((response)=>{
                        this.users = response.data
                        console.log(this.users,'sumair jutt');
                    })
            },

            created() {
                this.getUser()
            },
            message(){
              console.log('hy testing123')
            },
            save(){
                if (this.item.titleinput == "" || this.item.contenttextarea == "" || this.item.message == undefined || this.item.getHTML == "" || this.item.language == ""){
                    this.showAlert();
                }
                try {
                    axios.post('store', this.item)
                        .then(res =>{
                            this.item={
                                titleinput:"",
                                contenttextarea:"",
                                language:"",
                                tags:[],
                                getHTML:""
                            }

                            window.location.href = "/docs";
                            console.log('success')
                        })
                }catch (e) {
                    console.log(e)
                }
            },
            addTag (event) {
                event.preventDefault()
                var val = event.target.value.trim()
                if (val.length > 0) {
                    this.item.tags.push(val)
                    event.target.value = ''
                }
            },
            removeTag (index) {
                this.item.tags.splice(index, 1)
            },
        }
    }
</script>

<style lang="scss" scoped>
    .tiptap-editor button[data-v-523a86a5]{
        border: 1px solid black !important;
    }
    .editor-style{
        padding: 20px !important;
        margin-top: 15px !important;
    }
    .page-item.active .page-link{
        background-color: #fb8231 !important;
        border-color: #fb8231 !important;
    }
    .ProseMirror{
        padding: 20px !important;
        margin-top: 5px !important;
        border: 2px solid black !important;
    }
    .red{
        background: #fb8231 !important;
        color: white !important;
    }
    .border-box{
        border:1px solid black !important;
    }
    .border-box:hover{
        border: 1px solid #fb8231 !important;
    }
    .keywords-input{
        border: 1px solid #ced4da !important;
        border-radious: 13px !important;
        margin-top: 5px;
    }
    .tag-input {
        width: 100%;
        font-size: 0.9em;
        height: 50px;
        box-sizing: border-box;
        padding: 0 10px;
    }

    .tag-input__tag {
        height: 30px;
        float: left;
        margin-right: 10px;
        background-color: #eee;
        margin-top: 10px;
        line-height: 30px;
        padding: 0 5px;
        border-radius: 5px;
    }

    .tag-input__tag > span {
        cursor: pointer;
        opacity: 0.75;
    }

    .tag-input__text {
        border: none;
        outline: none;
        font-size: 0.9em;
        line-height: 50px;
        background: none;
    }
    .tiptap-editor button{
        padding: 5px 10px 5px 10px;
        border-radius: 9px;
        margin-top: 5px;
    }
    .ProseMirror{
        padding: 20px !important;
        margin-top: 5px !important;
        border: 2px solid black !important;
    }
    /* Basic editor styles */
    .ProseMirror {

        > * + * {
            margin-top: 0.75em;
        }

        ul,
        ol {
            padding: 0 1rem;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            line-height: 1.1;
        }

        code {
            background-color: rgba(#616161, 0.1);
            color: #616161;
        }

        pre {
            background: #0D0D0D;
            color: #FFF;
            font-family: 'JetBrainsMono', monospace;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;

            code {
                color: inherit;
                padding: 0;
                background: none;
                font-size: 0.8rem;
            }
        }

        img {
            max-width: 100%;
            height: auto;
        }

        blockquote {
            padding-left: 1rem;
            border-left: 2px solid rgba(#0D0D0D, 0.1);
        }

        hr {
            border: none;
            border-top: 2px solid rgba(#0D0D0D, 0.1);
            margin: 2rem 0;
        }
    }
    @media screen and (min-width: 766px) {
        /*.content-page{margin-left:0}*/
        .left-side-menu{position:absolute}
        body[data-sidebar-size=condensed] .content-page{margin-left:0!important;padding:0 15px 65px}
        /*body[data-sidebar-size=default] .content-page{padding:0 15px 65px;margin-left:0!important}*/
        /*.form-area{position:fixed}*/
        .form-area .form-left{margin-bottom:-999px;padding-bottom:999px;padding-top:20px;height:100%}
        /*.form-area .form-right{position:fixed;right:0;overflow:auto;padding:20px;height:87%}*/
        .dh-title.df{margin:20px 0 0;padding-bottom: 10px;}
        textarea.form-control{height: 100px;}
        .action-area{margin-top: 30px;padding: 15px 15px 20px 0;}}
    @media screen and (max-width: 765px) {
        .fr-area{padding:10px 15px 10px 10px}
        .action-area{position:fixed;bottom:0;width:100%;background:#f5f7fb;display:flex;justify-content:center;padding-right:0;align-items:center}}

    .delete-icon {
        margin-left: 0 !important;
    }
    .kiNLFp {
        padding: 20px;
        background-color: white;
        border: 1px solid rgb(132, 141, 211);
        width: 100%;
        border-radius: 10px;
        margin-bottom: 15px;
    }
    .fNjRST {
        display: flex;
        -moz-box-pack: center;
        justify-content: center;
        -moz-box-align: center;
        align-items: center;
        width: calc(100% + 40px);
        margin-top: 10px;
        margin-left: -20px;
        height: 260px;
        border-top: 1px solid rgb(220, 220, 220);
        border-bottom: 1px solid rgb(220, 220, 220);
    }
    .jOcitS {
        margin-bottom: 6px;
        left: 3rem;
        bottom: 2.25rem;
        font-family: Helvetica, Open Sans;
        line-height: 1.195rem;
    }
    .kxdBff {
        position: relative;
        width: calc(100% + 40px);
        margin-left: -20px;
        padding-left: 18px;
        padding-top: 8px;
        height: 78px;
        border-bottom: 1px solid rgb(220, 220, 220);
        background-color: rgb(240, 242, 245);
        font-family: Helvetica, Open Sans;
        font-size: 1rem;
        color: rgb(101, 103, 107);
    }
    .absolute-btn {
        position: absolute;
        right: 21%;
    }
    /* Basic editor styles */
    .ProseMirror {
        > * + * {
            margin-top: 0.75em;
        }

        code {
            background-color: rgba(#616161, 0.1);
            color: #616161;
        }
    }

    .content {
        padding: 1rem 0 0;

        h3 {
            margin: 1rem 0 0.5rem;
        }

        pre {
            border-radius: 5px;
            color: #333;
        }

        code {
            display: block;
            white-space: pre-wrap;
            font-size: 0.8rem;
            padding: 0.75rem 1rem;
            background-color:#e9ecef;
            color: #495057;
        }
    }
</style>
