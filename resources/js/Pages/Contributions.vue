<template>
    <AdminLayout>
        <v-container>
            <v-card max-width="1500" elevation="0">
                <v-card-title class="text-center" style="background-color: darkblue; color: white; border-radius: 40px;">
                    Applications List
                    <v-spacer></v-spacer>
                </v-card-title>
                <br>
                <v-card-text>
                    <v-chip color="red" @click="importApplications" class="mr-4" label elevation="5">
                        <v-icon left>mdi-upload</v-icon> Import
                    </v-chip>
                    <v-chip @click="printApplications" class="mr-4" label elevation="5">
                        <v-icon left>mdi-printer</v-icon> Print
                    </v-chip>
                    <v-chip color="green" @click="exportApplications" class="mr-4" label elevation="5">
                        <v-icon left>mdi-download</v-icon> Export
                    </v-chip>
                   
                </v-card-text>
                <br>
                <v-data-table
                    :headers="headers"
                    :items="applications"
                    :items-per-page="10"
                    class="elevation-0"
                >
                    <template v-slot:item.user="{ item }">
                        <span>{{ item.user.name }}</span>
                    </template>
                    <template v-slot:item.application_type="{ item }">
                        <span>{{ item.application_type.name }}</span>
                    </template>
                    <template v-slot:item.location="{ item }">
                        <span>{{ item.location.name }}</span>
                    </template>
                    <template v-slot:item.institution="{ item }">
                        <span>{{ item.institution.name }}</span>
                    </template>
                    <template v-slot:item.activity="{ item }">
                        <span>{{ item.activity.name }}</span> <!-- Adjust based on your Activity model -->
                    </template>
                    <template v-slot:item.preferred_start_date="{ item }">
                        <span>{{ item.preferred_start_date }}</span>
                    </template>
                    <template v-slot:item.description="{ item }">
                        <span>{{ item.description }}</span>
                    </template>
                    <template v-slot:item.cover_letter="{ item }">
                        <span>{{ item.cover_letter }}</span>
                    </template>
                    <template v-slot:item.status="{ item }">
                        <span>{{ item.status }}</span>
                    </template>
                    <template v-slot:item.created_at="{ item }">
                        <span>{{ new Date(item.created_at).toLocaleDateString() }}</span>
                    </template>
                    <template v-slot:item.actions="{ item }">
                        <v-dialog v-model="dialog.edit" max-width="500px">
                            <template v-slot:activator="{ on }">
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-chip icon color="white" v-bind="on">
                                            <v-icon color="green">mdi-pencil</v-icon>
                                        </v-chip>
                                    </template>
                                    <span>Edit</span>
                                </v-tooltip>
                            </template>
                            <v-card>
                                <v-card-title>Edit Application</v-card-title>
                                <v-card-text>
                                    <v-btn @click="saveEdit(item)">Save</v-btn>
                                    <v-btn @click="dialog.edit = false">Cancel</v-btn>
                                </v-card-text>
                            </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialog.view" max-width="500px">
                            <template v-slot:activator="{ on }">
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-chip icon color="white" v-bind="on">
                                            <v-icon color="primary">mdi-eye</v-icon>
                                        </v-chip>
                                    </template>
                                    <span>View</span>
                                </v-tooltip>
                            </template>
                            <v-card>
                                <v-card-title>View Application</v-card-title>
                                <v-card-text>
                                    <div>ID: {{ item.id }}</div>
                                    <div>Date: {{ new Date(item.created_at).toLocaleDateString() }}</div>
                                    <div>Description: {{ item.description }}</div>
                                    <div>Cover Letter: {{ item.cover_letter }}</div>
                                    <div>Status: {{ item.status }}</div>
                                    <div>Preferred Start Date: {{ item.preferred_start_date }}</div>
                                    <div>Member Name: {{ item.user.name }}</div>
                                    <div>Application Type: {{ item.applicationType.name }}</div>
                                    <div>Location: {{ item.location.name }}</div>
                                    <div>Institution: {{ item.institution.name }}</div>
                                    <div>Activity: {{ item.activity.name }}</div> <!-- Adjust based on your Activity model -->
                                </v-card-text>
                            </v-card>
                        </v-dialog>
                        <v-dialog v-model="dialog.delete" max-width="500px">
                            <template v-slot:activator="{ on }">
                                <v-tooltip top>
                                    <template v-slot:activator="{ on }">
                                        <v-chip icon color="white" v-bind="on">
                                            <v-icon color="red">mdi-delete</v-icon>
                                        </v-chip>
                                    </template>
                                    <span>Delete</span>
                                </v-tooltip>
                            </template>
                            <v-card>
                                <v-card-title>Delete Application</v-card-title>
                                <v-card-text>
                                    <div>Are you sure you want to delete this application?</div>
                                    <v-btn @click="confirmDelete(item)">Confirm</v-btn>
                                    <v-btn @click="dialog.delete = false">Cancel</v-btn>
                                </v-card-text>
                            </v-card>
                        </v-dialog>
                    </template>
                </v-data-table>
            </v-card>
        </v-container>
    </AdminLayout>
</template>

<script setup>
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

const { props } = usePage();
const applications = ref(props.applications);

const headers = [
    { title: 'ID', value: 'id' },
    { title: 'Date', value: 'created_at' },
    { title: 'Member Name', value: 'user.name' },
    { title: 'Application Type', value: 'application_type.name' },
    { title: 'Location', value: 'location.name' },
    { title: 'Institution', value: 'institution.name' },
    { title: 'Activity', value: 'activity.name' }, // Adjust based on your Activity model
    { title: 'Preferred Start Date', value: 'preferred_start_date' },
    { title: 'Description', value: 'description' },
    { title: 'Cover Letter', value: 'cover_letter' },
    { title: 'Status', value: 'status' },
    { title: 'Actions', value: 'actions', sortable: false },
];

const dialog = {
    edit: false,
    view: false,
    delete: false,
};

const saveEdit = (application) => {
    console.log('Saving edit:', application);
    dialog.edit = false;
};

const viewApplication = (application) => {
    console.log('Viewing application:', application);
    dialog.view = true;
};

const confirmDelete = (application) => {
    console.log('Deleting application:', application);
    dialog.delete = false;
};

const importApplications = () => {
    console.log('Importing applications');
};

const printApplications = () => {
    console.log('Printing applications');
};

const exportApplications = () => {
    console.log('Exporting applications');
};

const addApplication = () => {
    console.log('Adding a new application');
};
</script>

<style scoped>
/* Add scoped styles here */
</style>
