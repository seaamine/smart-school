<template>
    <div class="grid grid-cols-12 content-header mb-5">
        <div class="content-header-left col-span-9">
            <h2>Enseignants</h2>
        </div>
        <div class="content-header-right col-span-3 justify-self-end">
            <inertia-link :href="route('teacher.add')" as="button"
                          class="py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600"
                          method="get"
                          type="button">
                Nouveau enseignant
            </inertia-link>
        </div>
    </div>
    <div class="card p-6">
        <DataTable :sortOrder="1" :value="teachers" groupRowsBy="subject.name"
                   responsiveLayout="scroll" rowGroupMode="subheader" sortField="subject.name" sortOrder="1" scrollable scrollHeight="65vh" class=""
                   :loading="loading1" v-model:filters="filters1" :globalFilterFields="['first_name', 'last_name', 'dob', 'qualification','subject.name']"
                   :paginator="true" :rows="50"
        >
            <template #header>
                <div class="flex justify-end">
                    <div class="flex items-center" style="width: 250px;">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input class="form-control" style="padding-left: 30px;" type="text" v-model="filters1['global'].value" placeholder="Keyword Search" />
                        </div>
                </div>
            </template>
            <Column field="subject.name" header="Matière"></Column>
            <template #groupheader="slotProps">
                <img :alt="slotProps.data.subject.name" :src="slotProps.data.subject.image_path" width="32" style="vertical-align: middle" />
                <span class="image-text">{{slotProps.data.subject.name}}</span>
            </template>
            <Column header="#" headerStyle="width:3em">
                <template #body="slotProps">
                    {{ slotProps.index }}
                </template>
            </Column>
            <Column field="last_name" header="Nom"></Column>
            <Column field="first_name" header="Prénom"></Column>
            <Column field="dob" header="Date de naissaince">
                <template #body="slotProps">
                    {{ formatDate(slotProps.data.dob) }}
                </template>
            </Column>
            <Column field="qualification" header="Qualification">
            </Column>
            <Column :exportable="false">
                <template #body="slotProps">
                    <inertia-link :data="{ id: slotProps.data.id }" :href="route('teacher.edit',{'id':slotProps.data.id})" as="button"
                                  class="bg-primary-500 text-white  rounded-full w-10 h-10 font-medium inline-flex justify-center items-center mr-4 border border-primary-500 hover:ring-4 hover:ring-primary-100 focus:bg-primary-600 focus:outline-none active:bg-primary-600"
                                  method="get" title="Edit"
                                  type="button">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
                                stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"/>
                        </svg>
                    </inertia-link>
                    <button
                        class="mr-4 bg-danger-500 text-white rounded-full w-10 h-10 font-medium p-0 inline-flex justify-center items-center border border-danger-500 hover:ring-4 hover:ring-danger-200 focus:bg-danger-800 focus:outline-none active:bg-danger-800"
                        title="Delete">
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                  fill-rule="evenodd"/>
                        </svg>
                    </button>
                    <inertia-link :data="{ id: slotProps.data.user_id,role:'teacher' }" :href="route('login_as')"
                                  class="mr-4 bg-warning-500 text-white  rounded-full w-10 h-10 font-medium inline-flex justify-center items-center border border-warning-500 hover:ring-4 hover:ring-warning-200 focus:bg-warning-800 focus:outline-none active:bg-warning-800"
                                  method="get" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </inertia-link>
                    <inertia-link :data="{ id: slotProps.data.user_id }" :href="route('user.credentials')"
                                  class="bg-info-500 text-white  rounded-full w-10 h-10 font-medium inline-flex justify-center items-center mr-4 border border-info-500 hover:ring-4 hover:ring-info-200 focus:bg-info-800 focus:outline-none active:bg-info-800"
                                  method="get" title="change password">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </inertia-link>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import {FilterMatchMode,FilterOperator} from 'primevue/api';
import { ref  } from 'vue';

export default {
    components: {DataTable, Column},
    name: "Index",
    layout: DashLayout,
    props: {
        teachers: Array,
    },
    setup(props){
        const filters1 = ref({
            'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
            'first_name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
            'last_name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
            'qualification':{operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.EQUALS}]},
            'dob': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.DATE_IS}]},
            'subject.anme': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
        });
        const loading1 = ref(false);
        const clearFilter1 = () => {
            initFilters1();
        };
        const initFilters1 = () => {
            filters1.value = {
                'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'first_name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
                'last_name': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
                'qualification':{operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.EQUALS}]},
                'dob': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.DATE_IS}]},
                'subject.anme': {operator: FilterOperator.AND, constraints: [{value: null, matchMode: FilterMatchMode.CONTAINS}]},
                 }
        };

        return { filters1,loading1, clearFilter1, initFilters1}
    },
}
</script>

<style lang="scss"  scoped>
.p-rowgroup-footer td {
    font-weight: 700;
}

::v-deep(.p-rowgroup-header) {
    span {
        font-weight: 700;
    }
    .p-row-toggler {
        vertical-align: middle;
        margin-right: .25rem;
    }
}
</style>
