<script setup>
import { reactive } from 'vue';
import Navbar from '@/Components/Navbar.vue'; // Import the Navbar component
import { VCard, VCardTitle, VCardText, VImg, VContainer, VRow, VCol, VCarousel, VCarouselItem, VBtn, VIcon, VFooter } from 'vuetify/components'; // Import Vuetify components

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const state = reactive({
    carouselItems: [
        { src: '/Images/successful-happy-business-team.jpg' },
        { src: '/Images/african-american-business-woman-by-window.jpg' },
        { src: 'https://cdn.vuetifyjs.com/images/carousel/bird.jpg' },
        { src: 'https://cdn.vuetifyjs.com/images/carousel/planet.jpg' },
    ],
});
</script>

<template>
    <v-app>
    <Navbar /> <!-- Use the Navbar component -->

    <!-- Carousel Section -->
    <v-carousel height="600" class="mt-16" hide-delimiters="true" show-arrows="hover" cycle>
        <v-carousel-item src="/Images/medium-shot-hard-working-student.jpg" cover></v-carousel-item>
            </v-carousel>
  <!-- Information Section -->
  <v-container class="mt-16">
            <v-row>
                <v-col cols="12" md="6">
                    <h2 class="text-gray-900 font-bold text-3xl">Welcome to the Student Application Portal</h2>
                    <p class="mt-4 text-gray-600">
                        Our Student Application Portal is designed to streamline the application process for students. Whether you are applying for admission, scholarships, or other services, our portal provides a user-friendly experience to manage all your application needs.
                    </p>
                </v-col>
                <v-col cols="12" md="6">
                    <v-img src="/Images/student-support.jpg" height="300px"></v-img>
                </v-col>
            </v-row>
        </v-container>

        <!-- Download Section -->
        <v-container >
            <v-card-title class="text-center" style="background-color: green;color:white">Down Application materials</v-card-title>
            <br>
            <v-row>
                <v-col cols="12" md="4">
                    <v-card>
                        <v-card-title>Admission Application Form</v-card-title>
                        <v-card-text>
                            Download the admission application form to apply for new admissions.
                        </v-card-text>
                        <v-card-actions>
                            <v-btn color="green" variant="tonal" width="100%" style="text-transform: capitalize;" href="path/to/admission-application.pdf" download>
                                <v-icon left>mdi-download</v-icon>
                                Download
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                    <v-card>
                        <v-card-title>Scholarship Application Form</v-card-title>
                        <v-card-text>
                            Download the scholarship application form to apply for financial aid.
                        </v-card-text>
                        <v-card-actions>
                            <v-btn color="green" variant="tonal" width="100%" style="text-transform: capitalize;" href="path/to/scholarship-application.pdf" download>
                                <v-icon left>mdi-download</v-icon>
                                Download
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                    <v-card>
                        <v-card-title>Student Services Guide</v-card-title>
                        <v-card-text>
                            Download our guide to student services to learn more about the support available.
                        </v-card-text>
                        <v-card-actions>
                            <v-btn color="green" variant="tonal" width="100%" style="text-transform: capitalize;" href="path/to/student-services-guide.pdf" download>
                                <v-icon left>mdi-download</v-icon>
                                Download
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

        <!-- Footer Section -->
        <v-footer class="footer" style="background-color:green;color:white">
            <v-container>
                <v-row>
                    <v-col cols="12" md="4">
                        <v-img src="/Images/school-logo.png" height="60" contain></v-img>
                    </v-col>
                    <v-col cols="12" md="4">
                        <h3>Contact Us</h3>
                        <p>Email: admissions@university.edu</p>
                        <p>Phone: +254 700 111 222</p>
                    </v-col>
                    <v-col cols="12" md="4">
                        <h3>Follow Us</h3>
                        <v-btn icon>
                            <v-icon>mdi-facebook</v-icon>
                        </v-btn>
                        <v-btn icon>
                            <v-icon>mdi-twitter</v-icon>
                        </v-btn>
                        <v-btn icon>
                            <v-icon>mdi-instagram</v-icon>
                        </v-btn>
                    </v-col>
                </v-row>
            </v-container>
        </v-footer>
    </v-app>
</template>

<style scoped>
.pt-32 {
    padding-top: 8rem;
}
.md\\:py-12 {
    padding-top: 3rem;
    padding-bottom: 3rem;
}
.mt-16 {
    margin-top: 4rem;
}
.v-carousel-item .v-image__image--contain {
    object-fit: contain;
}
.footer {
    background-color: #f5f5f5; /* Light gray background */
    padding: 2rem 0; /* Padding for top and bottom */
    position: relative;
    bottom: 0;
    width: 100%;
}
</style>
