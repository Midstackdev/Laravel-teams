<template>
    <div class="stripe">
      <div id="card-element" class="mb-2"></div>
      <div id="card-errors" class="text-danger"></div>
      
      <input type="hidden" name="token" :value="token">
    </div>
</template>

<script>
    export default {
        data() {
            return {
                token: null
            }
        },

        mounted() {
            let stripe = Stripe('pk_test_9mM6gCNCBuKhOtsHKME02q5z00Ecrmc9je')
            let elements = stripe.elements()

            let card = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px',
                        color: '#32325d'
                    }
                }
            })

            card.addEventListener('change', (event) => {
                let displayError = document.getElementById('card-errors')

                if (event.error) {
                    displayError.textContent = event.error.message
                } else {
                    if (event.complete) {
                        stripe.createToken(card).then((result) => {
                            if (result.error) {
                                displayError.textContent = result.error.message
                            } else {
                                this.token = result.token.id
                            }
                        })
                    }
                }
            })

            card.mount('#card-element')
        }
    }
</script>
