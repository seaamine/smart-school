<template>
    <div class="grid grid-cols-12 content-header mb-5">
        <div class="content-header-left col-span-9">
            <h2>Années académiques</h2>
        </div>
        <div class="content-header-right col-span-3 justify-self-end">
            <inertia-link :href="route('academicYear.create')" method="get" as="button" type="button" class="py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600">Nouveau Année Académique</inertia-link>

        </div>
    </div>

    <div class="card p-6">
        <DataTable :value="yearsData">
            <Column field="title" header="Titre"></Column>
            <Column field="status" header="Status">
                <template #body="{data}">
                    <div class="flex justify-center">
                        <svg v-show="isSubmitting" class="animate-spin h-6 w-6 mr-3 text-warning-500" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-100" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <InputSwitch :disabled="isSubmitting" @click="changeCurrentYear(data.id)" :modelValue="checked[data.id]" />

                    </div>
                   </template>
            </Column>
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
import InputSwitch from 'primevue/inputswitch';

export default {
    layout: DashLayout,
    name: "index",
    props: {
        yearsData: Array,
    },
    components: {
        DataTable,
        Column,
        InputSwitch,
    },
    data() {
        return {
            checked: {},
            isSubmitting: false,
        }
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
        },
        processResponse(response,id){
            this.isSubmitting = false;
            if(response.data.type === 'error'){
                this.$toast.add({severity:'error', summary: response.data.toast.summary, detail:response.data.toast.detail, life: 5000});
            }else if (response.data.type === 'success'){
                this.$toast.add({severity:'success', summary: response.data.toast.summary, detail:response.data.toast.detail, life: 5000});
                Object.keys(this.checked).forEach(
                    yId=>{
                        if (yId != id) {
                            this.checked[yId]=false;
                        }else{
                            this.checked[yId]=true;
                        }
                    }
                );
            }

        },
        handleError(error){
            this.isSubmitting= false;
            const errorResponse = this.handleFetchError(error)
            this.$toast.add({severity:'error', summary : 'L\'opération a échoué!',detail:errorResponse.message, life: 5000});
        },
        changeCurrentYear(id){
            if(!this.checked[id]){
                if(this.isSubmitting){
                    return;
                }
                this.isSubmitting = true;
                const self = this;
                axios.post(this.route('academicYear.change-current'),{'id':id})
                    .then((response)=>{
                        self.processResponse(response,id)
                    }).catch(function (error) {
                    self.handleError(error);
                });

            }

        }
    },
    created() {
        this.yearsData.forEach(
            ay => {
                this.checked[ay.id] = (ay.status === '1')? true:false;
            }
        );
    },
}
</script>

<style scoped>

</style>
