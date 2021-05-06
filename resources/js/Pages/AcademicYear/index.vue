<template>
    <div class="content-header mb-5">
        <h2>Academic Years</h2>
    </div>
    <div class="card p-6">
        <DataTable :value="yearsData">
            <Column field="title" header="Titre"></Column>
            <Column field="start_date" header="Start date">
                <template #body="{data}">
                    {{formatDate(data.start_date)}}
                </template>
            </Column>
            <Column field="end_date" header="End date">
                <template #body="{data}">
                    {{formatDate(data.end_date)}}
                </template>
            </Column>
        </DataTable>
    </div>
</template>

<script>
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import DashLayout from "@/Layouts/DashLayout";

export default {
    layout: DashLayout,
    name: "index",
    props: {
        yearsData: Array,
    },
    components: {
        DataTable,
        Column,
    },
    data(){
      return {};
    },
    methods: {
        formatDate(value) {
            return new Date(value).toLocaleDateString('tzm-Latn-DZ', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
            });
        },
        formatCurrency(value) {
            return value.toLocaleString('tzm-Latn-DZ', {style: 'currency', currency: 'USD'});
        }
    }
}
</script>

<style scoped>

</style>
