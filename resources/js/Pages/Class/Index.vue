<template>
    <div class="grid grid-cols-12 content-header mb-5">
        <div class="content-header-left col-span-9">
            <h2>Classes</h2>
        </div>
        <div class="content-header-right col-span-3 justify-self-end">
            <inertia-link :href="route('class.add')" method="get" as="button" type="button" class="py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600">Nouveau Class</inertia-link>

        </div>
    </div>
    <div class="card p-6">
        <DataTable :value="classes" rowGroupMode="rowspan" groupRowsBy="level"
        sortMode="single" sortField="level" :sortOrder="1" responsiveLayout="scroll">
        <Column header="#" headerStyle="width:3em">
            <template #body="slotProps">
                {{slotProps.index}}
            </template>
        </Column>
        <Column field="level" header="Level" >
            <template #body="slotProps">
                <div class="text-white bg-primary-500 text-xl font-semibold text-center w-12 h-12 align-middle rounded-lg pt-1.5">{{slotProps.data.level}}</div>
            </template>
        </Column>
        <Column field="name" header="Name"></Column>
        <Column field="groups" header="Nombre de groupes">
         </Column>
        <Column field="status" header="Status">
            <template #body="slotProps">
                <span class="badge" :class="slotProps.data.status?'badge-success':'badge-danger'">{{slotProps.data.status ? 'actif':'inactif'}}</span>
            </template>
        </Column>
        <Column field="created_at" header="Date">
            <template #body="slotProps">
                {{formatDate(slotProps.data.created_at)}}
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
        classes: Array,
    },
    methods:{

    },
    components: {DataTable,Column},
}
</script>

<style scoped>
    >>> .p-card-title{
        height: 45px;
        font-size: 1rem;
        border: 1px solid rgba(34,41,47,.125);
        border-width: 0 0 1px;
        text-align: center;
        display: flex;
        align-items: center; /* Vertical center alignment */
        justify-content: center; /* Horizontal center alignment */
    }
    >>> .p-card-footer{
        height: 45px;
        font-size: 1rem;
        border: 1px solid rgba(34,41,47,.125);
        border-width: 1px 0 0 0;
        text-align: center;
        display: flex;
        align-items: center; /* Vertical center alignment */
        justify-content: center; /* Horizontal center alignment */
        color: #fff;
    }
</style>
