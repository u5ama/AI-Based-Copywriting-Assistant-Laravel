<template>
    <type-skip-layout>
        <div class="proj-dropdown dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <a href="#" class="d-h-flex">
                    <span><b class="sort-nname">MY</b><img src="https://usemagicopy.com/assets/admin/images/new/mp-img.svg" class="mp-img"></span>
                    <span>My Project</span>
                    <span><img src="https://usemagicopy.com/assets/admin/images/new/arrowup.svg" class="mp-img-drp"></span>
                </a>
            </button>
            <ul class="dropdown-menu ts-dropdown" aria-labelledby="dropdownMenu">
                <div class="project-wrap">
                    <h5>Create New Project <a href="#" data-toggle="modal" data-target="#createProject"><i class="fas fa-plus"></i></a></h5>
                    <div class="drp-user">
                        <span class="name-ltr pointer" onclick="change_project(17)">MY</span>
                        <span class="name-full pointer" onclick="change_project(17)" data-id="17">My Project<abbr> </abbr></span>
                        <span class="name-tick pointer" onclick="change_project(17)">
                            <img src="https://usemagicopy.com/assets/admin/images/new/green-check.svg">
                        </span>
                        <div class="dropdown dot-drop">
                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="three-dot">...</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li><a href="#" data-toggle="modal" data-id="17" data-name="My Project" data-target="#createProject" onclick="rename_project(this)"><i class="fas fa-edit"></i> Rename</a></li>
                                <li><a href="#" data-id="17" onclick="delete_project(this)"><i class="fas fa-trash-alt"></i> Delete</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="drp-user">
                        <span class="name-ltr pointer" onclick="change_project(22)">MI</span>
                        <span class="name-full pointer" onclick="change_project(22)" data-id="22">Mizan<abbr> </abbr></span>
                        <div class="dropdown dot-drop">
                            <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="three-dot">...</span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li><a href="#" data-toggle="modal" data-id="22" data-name="Mizan" data-target="#createProject" onclick="rename_project(this)"><i class="fas fa-edit"></i> Rename</a></li>
                                <li><a href="#" data-id="22" onclick="delete_project(this)"><i class="fas fa-trash-alt"></i> Delete</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between dh-title df">
                    <div class="fm-title">
                        <div class="fm-title-d bg-white">
                            <img src="/assets/admin/images/newTemplate/facebook-new.png">
                            <h3>Facebook<br>
                                <span class="fm-title-desc">A limitless supply of orignal Facebook Ad Copy</span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- end page title -->
        <!-------->
        <div class="row cards-body c-card">
            <div class="form-area">
                <div class="form-left">
                    <form action="google-ad" id="add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <span class="btm-char-count"><span class="brand-remaining-count">0</span><span>/80</span></span>
                            <label for="ctext">Brand Name:</label>
                            <input type="hidden" name="category" value="{{ encrypt($category) }}">
                            <input type="text"
                                   id="brand-remaining"
                                   maxlength="80"
                                   name="Company"
                                   placeholder="e.g. TypeSkip"
                                   class="ctext form-control brand-remaining"
                                   value="">
                            <span class="error" id="Company_error"></span>
                        </div>
                        <div class="form-group">
                            <span class="btm-char-count"><span class="description-remaining-count">0</span><span>/400</span></span>
                            <label for="company">Company or Product Description:</label>
                            <textarea type="text"
                                      name="CompanyDescription"
                                      maxlength="400"
                                      placeholder="Write high quality content, product descriptions, and more using just a few keywords or one-liners"
                                      id="company"
                                      rows="3"
                                      class="form-control description-remaining">aa</textarea>
                            <span class="error" id="CompanyDescription_error"></span>
                        </div>
                        <div class="form-group addKeyword-field" id="addKeyword-field-1">
                            <label for="ctext">Add Keywords:</label>
                            <input type="text"
                                   id="AddKeywordstags"
                                   name="add_keywords"
                                   value="{{ old('add_keywords') ? old('add_keywords') : $contents[0]['ads']->add_keywords ?? ''}}"
                                   class="form-control ctext"
                                   multiple="multiple"
                                   aria-describedby="ctext">
                            <span class="error" id="addkeywords_error"></span>
                        </div>
                        <div class="form-group MuiCollapse-container MuiCollapse-hidden" style="min-height: 0px;">
                            <div class="MuiCollapse-wrapper">
                                <div class="MuiCollapse-wrapperInner">
                                    <div class="MuiPaper-root MuiAlert-root MuiAlert-standardError MuiPaper-elevation0" role="alert">
                                        <div class="MuiAlert-message">Please fill in all required elements and press 'Generate'. </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="action-area">
                            <div class="outputs">
                                <input id="nValue" value="5" type="number" name="number_of_outputs" min="1" max="15" aria-describedby="ideas" autocomplete="off" class="pr-20 form-input">
                                <span>Outputs</span>
                            </div>
                            <h5 class="plz_wait" style="display: inline-block;width: 164px;position: relative;height: auto;">
                                <img style="width: 255px;height: auto;position: absolute;top: -120px;left: -55px;" src="{{asset('assets/admin/loader/please_wait_new.gif')}}">
                            </h5>
                            <button type="button" id="submit_btn" class="btn btn-secondary cancel-button mdl-btn" data-dismiss="modal">Generate</button>
                        </div>
                    </form>
                </div> <!-- end card-box -->
            </div>
        </div>
    </type-skip-layout>
</template>

<script>
    import TypeSkipLayout from "@/Layouts/TypeSkipLayout";
    export default {
        name: "App",
        components:{
            TypeSkipLayout
        },
    }
</script>

<style scoped>
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
</style>
