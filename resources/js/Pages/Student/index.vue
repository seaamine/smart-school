<template>
    <div class="grid grid-cols-12 content-header mb-5">
        <div class="content-header-left col-span-9">
            <h2>Étudiantes</h2>
        </div>
        <div class="content-header-right col-span-3 justify-self-end">
            <inertia-link :href="route('student.add')" method="get" as="button" type="button" class="py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600">Nouveau Etudiant</inertia-link>

        </div>
    </div>
    <div class="card p-6">
        <DataTable dataKey="id"  :loading="loading" :paginator="true" :rows="25" :sortOrder="1" :value="students" groupRowsBy="level"
                   responsiveLayout="scroll" rowGroupMode="rowspan" sortField="level" sortMode="single">
            <template #loading>
                Chargement des données des étudiants. S'il vous plaît, attendez.
            </template>
            <template #empty>
                Aucun étudiant trouvé.
            </template>
            <template #header>
                <div class="flex justify-end">
                        <span class="p-input-icon-left ">
                            <i class="pi pi-search" />
                            <input type="text" v-model="" class="form-control" style="padding-left: 30px;" placeholder="Keyword Search">
                        </span>
                </div>
            </template>
            <Column header="#" headerStyle="width:3em">
                <template #body="slotProps">
                    {{ slotProps.index }}
                </template>
            </Column>
            <Column field="last_name" header="Nom" :sortable="true"></Column>
            <Column field="first_name" header="Prénom" :sortable="true"></Column>
            <Column field="dob" header="Date de naissaince" :sortable="true">
                <template #body="slotProps">
                    {{ formatDate(slotProps.data.dob) }}
                </template>
            </Column>
            <Column field="status" header="Status" :sortable="true">
                <template #body="slotProps">
                    <span :class="slotProps.data.status?'badge-success':'badge-danger'"
                          class="badge">{{ slotProps.data.status ? 'actif' : 'inactif' }}</span>
                </template>
            </Column>
            <Column field="created_at" header="Date" :sortable="true">
                <template #body="slotProps">
                    {{ formatDate(slotProps.data.created_at) }}
                </template>
            </Column>
            <Column :exportable="false">
                <template #body="slotProps">
                    <inertia-link :data="{ id: slotProps.data.id }" :href="route('student.add')" as="button"
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
                        class="bg-danger-500 text-white rounded-full w-10 h-10 font-medium p-0 inline-flex justify-center items-center border border-danger-500 hover:ring-4 hover:ring-danger-200 focus:bg-danger-800 focus:outline-none active:bg-danger-800"
                        title="Delete">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd"
                                  d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                  fill-rule="evenodd"/>
                        </svg>
                    </button>
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
export default {
    name: "index",
    layout: DashLayout,
    props: {
        students: Array,
    },
    methods: {},
    components: {DataTable, Column},
}
</script>

<style scoped>

</style>
