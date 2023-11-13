export default App;
import axios from 'axios';
import Vue from 'vue';
import Datepicker from 'vuejs-datepicker';

Vue.component('calendrier-component', {
    data() {
        return {
            selectedDate: null, // Date sélectionnée par l'utilisateur
            totalMontant: 0, // TotalMontant à afficher, vous pouvez le mettre à jour dynamiquement
        };
    },
    methods: {
        // Méthode appelée lorsque l'utilisateur sélectionne une date
        selectDate(date) {
            // Mettez à jour la date sélectionnée
            this.selectedDate = date;

            // Mettez à jour le totalMontant en faisant une requête AJAX à votre backend Symfony
            // Utilisez la date sélectionnée pour récupérer le totalMontant approprié
            // Mettez à jour this.totalMontant avec la réponse de la requête AJAX
            this.updateTotalMontant();
        },
        updateTotalMontant() {
            // Exemple de requête AJAX avec Axios
            axios.get('/votre_backend_symfony/endpoint_pour_total_montant', {
                params: {
                    date: this.selectedDate,
                },
            })
            .then(response => {
                // Mettez à jour this.totalMontant avec la réponse de la requête
                this.totalMontant = response.data.totalMontant;
            })
            .catch(error => {
                console.error('Erreur lors de la récupération du totalMontant', error);
            });
        },
    },
    components: {
        Datepicker,
    },
    template: `
        <div>
            <h1>Calendrier avec Vue.js</h1>
            
            <!-- Composant de calendrier -->
            <datepicker v-model="selectedDate" @selected="selectDate"></datepicker>

            <!-- Afficher le totalMontant -->
            <p v-if="selectedDate">Total Montant pour {{ selectedDate }} : {{ totalMontant }}</p>
        </div>
    `,
});

// Créez une instance Vue et montez le composant sur l'élément #calendar
new Vue({
    el: '#calendar',
    template: '<calendrier-component></calendrier-component>',
});
