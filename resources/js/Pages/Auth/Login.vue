<template>
    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors class="mb-4" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
            </div>

            <div class="mt-4">
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <jet-checkbox name="remember" v-model="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <inertia-link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </inertia-link>

                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Login
                </jet-button>
            </div>

            <!--

            <div>
                <a href="/linelogin">LINEログイン</a>
            </div>
            <div>
                <a href="/line/redirect">LINEでログイン@@@@</a>
            </div>
            
            -->


            <div class="m-5">
                <hr></hr>

                <!--
                <div>
                    <a href="/auth/redirect">
                        <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" style="margin-left: 3em;">
                    </a>
                </div>  

                <div>
                    <a href="login/google">
                        <img :src="'/img/btn_google_login.png'" alt="" class="w-100">
                    </a>
                </div>


                -->





                <div class="mt-5 flex items-center">
                    <jet-button class="ml-0 bg-blue-900 w-4/5">
                        <a href="login/google">
                            Login with Google
                        </a>
                    </jet-button>
                </div>


                <div class="flex items-center">
                    <jet-button class="ml-0 bg-red-500 w-4/5">
                        <a href="login/yahoo">
                            Login with Yahoo
                        </a>
                    </jet-button>
                </div>


                <div class="flex items-center">
                    <jet-button class="ml-0 bg-green-500 w-4/5">
                        <a href="login/line">
                            Login with LINE
                        </a>
                    </jet-button>
                </div>


                <div class="flex items-center">
                    <jet-button class="ml-0 bg-blue-400 w-4/5">
                        <a href="login/twitter">
                            Login with Twitter
                        </a>
                    </jet-button>
                </div>


                <div class="flex items-center">
                    <jet-button class="ml-0 bg-gray-200 w-4/5">
                        <a href="login/github">
                            Login with Github
                        </a>
                    </jet-button>
                </div>


                <div class="flex items-center">
                    <jet-button class="ml-0 bg-blue-700 w-4/5">
                        <a href="login/facebook">
                            Login with Facebook
                        </a>
                    </jet-button>
                </div>

                <div class="flex items-center">
                    <jet-button class="ml-0 bg-pink-700 w-4/5">
                        <a href="login/instagram">
                            Login with Instagram
                        </a>
                    </jet-button>
                </div>



    <!--
                <div >
                    <a href="login/line">
                        <img :src="'/img/btn_login_base.png'" alt="" class="c-img">
                    </a>
                </div>
                
                
                <div>
                    <a href="login/twitter">
                        <img :src="'/img/btn_twitter_login.png'" alt="" class="c-img">
                    </a>
                </div>



                <div >
                    <a href="login/github">
                        <img :src="'/img/btn_login_github.png'" alt="" class="c-img">
                    </a>
                </div>


                <hr></hr>


                <div>
                error
                    <a href="login/yahoo">
                        <img :src="'/img/btn_yahoo_login.png'" alt="" class="c-img">
                    
                    </a>
                </div>

                <div>
                    <a href="login/yahoojp">yahoojp</a>
                </div>

                <div class="btn btn-social-icon btn-facebook">
                    <a href="login/facebook">
                        <img :src="'/img/btn_facebook_login.png'" alt="" class="c-img">
                    </a>
                </div>

                <div>
                    <a href="login/slack">
                        <img :src="'/img/btn_slack_login.png'" alt="" class="c-img">
                    </a>
                </div>

                <div>
                    <a href="login/instagram">
                        <img :src="'/img/btn_instagram_login.png'" alt="" class="c-img">
                    </a>
                </div>
    --->




            </div>

            
        </form>
    </jet-authentication-card>
</template>

<script>
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'
    import JetCheckbox from '@/Jetstream/Checkbox'
    import JetLabel from '@/Jetstream/Label'
    import JetValidationErrors from '@/Jetstream/ValidationErrors'

    export default {
        components: {
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>
