<template>
    <div class="content-header mb-5">
        <h2>Modèle de certificat scolaire</h2>
    </div>
    <div v-if="Object.keys(errors).length" class="card card-danger p-6 mb-4 text-white">
        <ul class="list-disc">
            <li v-for="error in errors">
                {{error}}
            </li>
        </ul>
    </div>
    <div class="card p-6" >
        <div class="document-editor">
            <editor
                v-model="editorData"
            :init="{
            height: 500,
            skin:false,
            content_css:false,
            menubar: false,
              plugins: 'print preview paste importcss searchreplace save directionality visualblocks visualchars fullscreen charmap hr pagebreak nonbreaking  toc insertdatetime advlist lists wordcount textpattern noneditable charmap quickbars',
             toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap | fullscreen preview print | ltr rtl',

            }"
            />
        </div>
        <div class="flex justify-evenly mt-4">
            <button :disabled="isSubmitting" @click="submitTemplate()" class=" mr-4 w-1/3 py-4 text-white rounded-md font-medium bg-primary-500 py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                <svg v-show="isSubmitting" class="animate-spin h-6 w-6 mr-3 text-warning-500" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-100" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Sauvegarder
            </button>
        </div>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
//import Editor from 'ckeditor5-custom-build/build/ckeditor'
//import CKEditor from '@ckeditor/ckeditor5-vue';
//import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import "tinymce/tinymce";
import "tinymce/themes/silver";
import "tinymce/icons/default";
import 'tinymce/skins/ui/oxide/skin.min.css';
import 'tinymce/skins/ui/oxide/content.min.css';
import 'tinymce/skins/content/default/content.min.css';

// Default icons are required for TinyMCE 5.3 or above
// Any plugins you want to use has to be imported
import 'tinymce/plugins/save';
import 'tinymce/plugins/directionality';
import 'tinymce/plugins/visualblocks';
import 'tinymce/plugins/visualchars';
import 'tinymce/plugins/fullscreen';
import 'tinymce/plugins/paste';
import 'tinymce/plugins/link';
import 'tinymce/plugins/preview';
import 'tinymce/plugins/print';
import 'tinymce/plugins/paste';
import 'tinymce/plugins/importcss';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/table';
import 'tinymce/plugins/hr';
import 'tinymce/plugins/pagebreak';
import 'tinymce/plugins/nonbreaking';
import 'tinymce/plugins/toc';
import 'tinymce/plugins/insertdatetime';
import 'tinymce/plugins/lists';
import 'tinymce/plugins/wordcount';
import 'tinymce/plugins/textpattern';
import 'tinymce/plugins/noneditable';
import 'tinymce/plugins/quickbars';
import 'tinymce/plugins/charmap';
import 'tinymce/plugins/advlist';

import Editor from '@tinymce/tinymce-vue'

export default {
    name: "Edit",
    components: {
        // Use the <ckeditor> component in this view.
        'editor': Editor,
    },
    layout: DashLayout,
    props:{
        errors: Object,
        template: String,
    },
    data(){
        return {
            editorData: this.template ?? '',
            editorConfig: {
                toolbar: {

                }
            },
            isSubmitting: false,
        };
    },
    methods: {finalview(){
        },
        onReady( editor )  {
            // Insert the toolbar before the editable area.
            editor.ui.getEditableElement().parentElement.insertBefore(
                editor.ui.view.toolbar.element,
                editor.ui.getEditableElement()
            );
        },
        processResponse(response){
            this.isSubmitting= false;
            if(response.data.type === 'error'){
                this.$toast.add({severity:'error', summary: response.data.toast.summary, detail:response.data.toast.detail, life: 5000});
            }else if (response.data.type === 'success'){
                this.$toast.add({severity:'success', summary: response.data.toast.summary, detail:response.data.toast.detail, life: 5000});
            }

        },
        handleError(error){
            this.isSubmitting= false;
            const errorResponse = this.handleFetchError(error)
            this.$toast.add({severity:'error', summary : 'L\'opération a échoué!',detail:errorResponse.message, life: 5000});
        },
        submitTemplate(){
            this.isSubmitting = true;
            const self = this;
            axios.post(this.route('school-certificate.update'),{'template': this.editorData})
                .then((response)=>{
                    self.processResponse(response)

                    //this.initTrimester(tri,response.data.exam)
                }).catch(function (error) {
                self.handleError(error);
            });
        }
    }

}
</script>
<style  scoped>


</style>
