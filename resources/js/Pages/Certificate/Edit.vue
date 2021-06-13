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
            <ckeditor style="height: 375px;" @ready="onReady" :editor="editor" v-model="editorData"></ckeditor>
        </div>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import CKEditor from '@ckeditor/ckeditor5-vue';
//import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import  DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document'
export default {
    name: "Edit",
    components: {
        // Use the <ckeditor> component in this view.
        ckeditor: CKEditor.component
    },
    layout: DashLayout,
    props:{
        errors: Object,
    },
    data(){
        return {
            editor: DecoupledEditor,
            editorData: '<p>Content of the editor.</p>',
            editorConfig: {
                toolbar: {

                }
            },
            template:null,
        };
    },
    methods: {
        onReady( editor )  {
            // Insert the toolbar before the editable area.
            editor.ui.getEditableElement().parentElement.insertBefore(
                editor.ui.view.toolbar.element,
                editor.ui.getEditableElement()
            );
        }
    }

}
</script>
<style scoped>
.document-editor {
    border: 1px solid var(--ck-color-base-border);
    border-radius: var(--ck-border-radius);

    /* Set vertical boundaries for the document editor. */
    max-height: 700px;

    /* This element is a flex container for easier rendering. */
    display: flex;
    flex-flow: column nowrap;
}
.document-editor__toolbar {
    /* Make sure the toolbar container is always above the editable. */
    z-index: 1;

    /* Create the illusion of the toolbar floating over the editable. */
    box-shadow: 0 0 5px hsla( 0,0%,0%,.2 );

    /* Use the CKEditor CSS variables to keep the UI consistent. */
    border-bottom: 1px solid var(--ck-color-toolbar-border);
}

/* Adjust the look of the toolbar inside the container. */
.document-editor__toolbar .ck-toolbar {
    border: 0;
    border-radius: 0;
}
</style>
