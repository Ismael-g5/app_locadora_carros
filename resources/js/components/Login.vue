<template>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    {{ email }} - {{ password }}
                    <div class="card-body"><!--o submite.prevent realiza alguma ação desejada antes do metodo informado-->
                        <form method="POST" action="" @submit.prevent="login($event)">
                            <!--token csrf-->
                            <input type="hidden" name="_token" :value="token_csrf">

                              <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"  required autocomplete="email" autofocus v-model="email">
                                <!--o vmodel chama os methods declarados no script-->

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Mantenha-me conectado
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>


                                    <a class="btn btn-link" href="#">
                                        Esqueci a senha
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

        export default{ //props tem o funcionamento semelhante a data
            //o component não trabalha com camelcase, então devo passar o prop sempre minusculo
           //o metodo fetch permite fazer requisições http
            props: [
            'token_csrf'
            ],
            data(){
                return{
                    email: '',
                    password: ''
                }
            },
            methods: {
                login(e){

                  //  console.log(this.email, this.password)  dentro de methods precisamos chamar com this.

                    let url = 'http://localhost:8000/api/login'
                    let configuracao = {
                        method: 'post',
                        body: new URLSearchParams ({ //UrlSearchParams é nativo do js
                            'email': this.email,
                            'password': this.password,
                        })

                    }
                    fetch(url,configuracao)// data pega ao resultado de .then anterior
                        .then(response => response.json())
                        .then(data => {
                            if(data.token){
                                document.cookie = 'token='+data.token // lembrese de passar sempre o '=' para considerar como name oq estiver dentro da string
                            }
                            //da prossguimento ao processo de autenticação por seção
                            e.target.submit()
                        })
                }

            }
        }



</script>
