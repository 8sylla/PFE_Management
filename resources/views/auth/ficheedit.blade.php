<style>
/* CSS moderne pour le formulaire PFE */

.card {
    max-width: 800px;
    margin: 20px auto;
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    padding: 0;
    overflow: hidden;
    border: none;
    animation: slideUp 0.6s ease-out;
    position: relative;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Effet de glassmorphisme pour la carte */
.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.1));
    backdrop-filter: blur(10px);
    border-radius: 20px;
    z-index: -1;
}

.title {
    display: block;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 30px;
    font-size: 2.2rem;
    font-weight: 700;
    text-align: center;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    position: relative;
}

.title::after {
    content: '📋';
    position: absolute;
    right: 30px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 2rem;
}

.form {
    padding: 40px;
    background: transparent;
}

.group {
    position: relative;
    margin-bottom: 30px;
    transition: transform 0.3s ease;
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
    transform: translateY(20px);
}

.group:hover {
    transform: translateY(-2px);
}

/* Animation delays pour les groupes */
.group:nth-child(1) { animation-delay: 0.1s; }
.group:nth-child(2) { animation-delay: 0.2s; }
.group:nth-child(3) { animation-delay: 0.3s; }
.group:nth-child(4) { animation-delay: 0.4s; }
.group:nth-child(5) { animation-delay: 0.5s; }
.group:nth-child(6) { animation-delay: 0.6s; }
.group:nth-child(7) { animation-delay: 0.7s; }

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.group input,
.group textarea {
    width: 100%;
    padding: 16px 20px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 16px;
    font-family: inherit;
    background: #fafbfc;
    transition: all 0.3s ease;
    outline: none;
    box-sizing: border-box;
}

.group input:focus,
.group textarea:focus {
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.group label {
    position: absolute;
    top: 16px;
    left: 20px;
    color: #64748b;
    font-size: 16px;
    font-weight: 500;
    pointer-events: none;
    transition: all 0.3s ease;
    background: transparent;
}

.group input:focus + label,
.group input:not(:placeholder-shown) + label,
.group textarea:focus + label,
.group textarea:not(:placeholder-shown) + label {
    top: -12px;
    left: 16px;
    font-size: 12px;
    color: #667eea;
    background: white;
    padding: 4px 8px;
    border-radius: 6px;
    font-weight: 600;
}

.group textarea {
    resize: vertical;
    min-height: 120px;
    font-family: inherit;
}

/* Styles pour les boutons radio */
.rad {
    background: linear-gradient(145deg, #f8fafc, #e2e8f0);
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
    border: 2px solid #e2e8f0;
    transition: all 0.3s ease;
    font-weight: 600;
    color: #334155;
    animation: fadeInUp 0.6s ease-out 0.8s forwards;
    opacity: 0;
    transform: translateY(20px);
}

.rad:hover {
    border-color: #667eea;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.15);
}

.rad input[type="radio"] {
    appearance: none;
    width: 20px;
    height: 20px;
    border: 2px solid #cbd5e1;
    border-radius: 50%;
    margin: 0 8px 0 20px;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
    vertical-align: middle;
}

.rad input[type="radio"]:checked {
    border-color: #667eea;
    background: #667eea;
}

.rad input[type="radio"]:checked::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 8px;
    height: 8px;
    background: white;
    border-radius: 50%;
}

.rad input[type="radio"]:hover {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Styles pour le select */
select {
    width: 100%;
    padding: 16px 20px;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 16px;
    background: #fafbfc;
    cursor: pointer;
    transition: all 0.3s ease;
    appearance: none;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%23667eea' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 12px center;
    background-repeat: no-repeat;
    background-size: 16px;
    padding-right: 50px;
    margin-bottom: 30px;
    box-sizing: border-box;
    animation: fadeInUp 0.6s ease-out 0.9s forwards;
    opacity: 0;
    transform: translateY(20px);
}

select:focus {
    outline: none;
    border-color: #667eea;
    background-color: white;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

select option {
    padding: 12px;
    background: white;
    color: #334155;
}

/* Styles pour le bouton submit */
button[type="submit"] {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 18px 40px;
    border-radius: 50px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
    position: relative;
    overflow: hidden;
    width: 100%;
    max-width: 300px;
    margin: 20px auto 0;
    display: block;
    text-transform: uppercase;
    letter-spacing: 1px;
    animation: fadeInUp 0.6s ease-out 1s forwards;
    opacity: 0;
    transform: translateY(20px);
}

button[type="submit"]:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(102, 126, 234, 0.6);
}

button[type="submit"]:active {
    transform: translateY(-1px);
}

button[type="submit"]::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

button[type="submit"]:hover::before {
    left: 100%;
}

/* Styles pour les messages d'erreur Laravel */
.invalid-feedback {
    color: #e53e3e;
    font-size: 14px;
    margin-top: 5px;
    font-weight: 500;
}

.is-invalid {
    border-color: #e53e3e !important;
    box-shadow: 0 0 0 4px rgba(229, 62, 62, 0.1) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .card {
        margin: 10px;
        border-radius: 15px;
    }
    
    .title {
        font-size: 1.8rem;
        padding: 20px;
    }
    
    .title::after {
        right: 20px;
        font-size: 1.5rem;
    }
    
    .form {
        padding: 20px;
    }
    
    .group {
        margin-bottom: 25px;
    }
    
    .rad {
        padding: 15px;
    }
    
    .rad input[type="radio"] {
        margin: 10px 8px 10px 0;
        display: inline-block;
    }
}
</style>

@extends('auth.teacherdashboard')
@section('content')
    <div class="card">
        <span class="title">Fiche PFE</span>
        <form class="form" name="F" method="POST" action="{{ route('updatefiche',$data['id']) }}">
          @csrf

          <div class="group">
            <input placeholder="‎" type="text" name="societe_acceuil" value={{$data['societe_acceuil'] }} required="" >
            <label for="name">Societe d'acceuil</label>
          </div>

          <div class="group">
            <input placeholder="‎" type="text" id="enc" name="encadrant_externe" value={{$data['encadrant_externe'] }} required="" >
            <label for="enc">Encadrant externe</label>
          </div>

          <div class="group">
            <input placeholder="‎" type="text" id="tel" name="ntel_societe" value={{$data['ntel_societe'] }}  required="" >
            <label for="tel">Numero tel de Societe </label>
          </div>

          <div class="group">
            <input placeholder="‎" type="email" id="email" name="mail_societe" value={{$data['mail_societe'] }} required="" >
            <label for="email">Email Societe</label>
          </div>

          <div class="group">
            <input placeholder="‎" type="text" id="tit" name="intitule_pfe" value={{$data['intitule_pfe'] }} required="" >
            <label for="tit">Intitulé du PFE</label>
          </div>

           <div class="group">
            <textarea placeholder="‎" id="bes" name="besions_fonctionnels" rows="5" required="" >{{$data['besions_fonctionnels'] }}</textarea>
            <label for="bes">Besion fonctionnels</label>
          </div>

          <div class="group">
            <textarea placeholder="‎" id="tech" name="technologies_utilisees" rows="5" required="" >{{$data['technologies_utilisees'] }}</textarea>
            <label for="tech">Technologies utilisees</label>
          </div>

          
          <div class="r" >
            Langue:
            <input name="langue" type="radio" value="Francais" {{ $data->langue === 'Francais' ? 'checked' : '' }}/> Francais
            <input name="langue" type="radio" value="Anglais" {{ $data->langue === 'Anglais' ? 'checked' : '' }}/>  Anglais
        </div>

        <select name="Remarque">
          <option value="en Attente" {{ $data['Remarque'] === 'en Attente' ? 'selected' : '' }}>En Attente</option>
          <option value="accepte" {{ $data['Remarque'] === 'accepte' ? 'selected' : '' }}>Accepte</option>
          <option value="refuse" {{ $data['Remarque'] === 'refuse' ? 'selected' : '' }}>Refuse</option>
      </select><br><br>

          
          <button type="submit">Submit</button><br>

        </form>
          
    </div>
        
@endsection