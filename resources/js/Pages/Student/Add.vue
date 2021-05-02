<template>
<p>hello</p>
    <div class="content-header mb-5">
        <h2>New Academic Year</h2>
    </div>
    <div class="card p-6">
        <form>
            <div class="form-group">
                <Label>Titre</Label>
                <input class="form-control" type="text" placeholder="Titre">
            </div>
            <div class="form-group">
                <Label>Start Date</Label>
                <Calendar v-model="value" class="w-full" :inputClass="'form-control'" />
            </div>
            <div class="form-group">
                <Label>End Date</Label>
                <input class="form-control" type="text" placeholder="Titre">
            </div>
            <div>
                <button type="submit" class="py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 hover:bg-primary-500 hover:bg-opacity-40">Save</button>
                <button class="py-3 px-6 rounded-md text-secondary-500 font-semibold border border-secondary-500 hover:bg-secondary-500 hover:bg-opacity-40 active:bg-secondary-500 active:bg-opacity-20">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import Label from "@/Jetstream/Label";
import Button from "@/Jetstream/Button";
import Calendar from 'primevue/calendar';
export default {
    components:{Button, Label, Calendar},
    // Using the shorthand
    layout: DashLayout,
}
</script>

<style scoped>

</style>
