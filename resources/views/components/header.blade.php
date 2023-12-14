<div>
<a href="{{ route('accueil') }}"><button>🏛 Accueil</button></a>
@auth
    <a href="{{ route('sports.index') }}"><button>🥇 Sports</button></a>
@endauth
<a href="{{ route('apropos') }}"><button>ℹ️ A propos</button></a>
<a href="{{ route('contact') }}"><button> Contact</button></a>
</div>
<span class="a-droite"></span>
@guest
    <div>
        <button><a href="{{route('register')}}">📥 Enregistrement</a></button>
        <button><a href="{{route('login')}}">😎 Connexion</a></button>
    </div>
@endguest
@auth
    <div>
        {{Auth::user()->name}}
        <button><a href="#" id="logout">Logout</a>
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <script>
        document.getElementById('logout').addEventListener("click", (event) => {
            document.getElementById('logout-form').submit();
        });
    </script>
@endauth
