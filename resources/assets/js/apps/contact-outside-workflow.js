const appName = 'vue-contact-outside-workflow'

import editMixins from '../mixins/edit-mixins'

if (jQuery("#" + appName).length > 0) {
    const app = new Vue({
        el: '#'+appName,

        mixins: [editMixins],

        data: {
            laravel: laravel,
            currentContactType: '' ,
            currentContact:  '',
            contactTypesArray: [],
            refreshing: false,
        },

        computed: {
            mask: function () {
                let mask = "*".repeat(255)

                switch (this.currentContactTypeName) {
                    case 'mobile' :
                        mask = ['(##) #####-####'];
                        break;
                    case 'whatsapp' :
                        mask = ['(##) #####-####'];
                        break;
                    case 'phone':
                        mask = '(##) ####-####';
                        break;
                }

                return mask
            },

            masked() {
                return true
            },

            currentContactTypeName: function () {
                return this.contactTypesArray[this.currentContactType]
            },

            tokens() {
                return {
                    '*': {pattern: /.*/},
                    '#': {pattern: /\d/},
                    'X': {pattern: /[0-9a-zA-Z]/},
                    'S': {pattern: /[a-zA-Z]/},
                    'A': {pattern: /[a-zA-Z]/, transform: v => v.toLocaleUpperCase()},
                    'a': {pattern: /[a-zA-Z]/, transform: v => v.toLocaleLowerCase()},
                    '!': {escape: true}
                }
            }
        },

        methods: {
            refresh() {
                this.refreshContactTypesArray()
            },

            refreshContactTypesArray() {
                me = this

                me.refreshing = true

                axios.get('/callcenter/contact_types/array')
                    .then(function(response) {
                        me.contactTypesArray = response.data

                        me.refreshing = false
                    })
                    .catch(function(error) {
                        console.log(error)

                        me.contactTypesArray = []

                        me.refreshing = false
                    })
            },

            initializeCurrents() {
                this.currentContactType = laravel.length == 0 ? '' : laravel.contact.contact_type_id
                if(laravel.length == 0) {
                    this.currentContact = ''
                } else {
                    if(laravel.old.contact != null) {
                        this.currentContact = laravel.old.contact
                    } else {
                        this.currentContact = laravel.contact.contact
                    }
                }
            }
        },

        beforeMount() {
            this.refresh()
        },

        mounted() {
            this.initializeCurrents()

            me = this

            $("#contact_type_id").on('change', function () {
                e = document.getElementById("contact_type_id")
                me.currentContactType = e.options[e.selectedIndex].value
            })
        }

    })
}
