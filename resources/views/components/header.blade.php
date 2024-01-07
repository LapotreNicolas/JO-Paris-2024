<div>
<a href="{{ route('home') }}"><button>🏛 Accueil</button></a>
@auth
    <a href="{{ route('sports.index') }}"><button>💪 Sports</button></a>
    <a href="{{ route('athletes.index') }}"><button>🏃 Athletes</button></a>
    <a href="{{ route('medailles') }}"><button>🏅 Médailles</button></a>
@endauth
<a href="{{ route('apropos') }}"><button>ℹ️ A propos</button></a>
<a href="{{ route('contact') }}"><button>💬 Contact</button></a>
</div>
<span class="a-droite"></span>
@guest
    <div>
        <a href="{{route('register')}}"><button>📥 Enregistrement</button></a>
        <a href="{{route('login')}}"><button>😎 Connexion</button></a>
    </div>
@endguest
@auth
    <div>
        {{Auth::user()->name}}
        <a href="#" id="logout"><button>Logout</button></a>
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
