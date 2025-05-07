@php
    $compro = \App\Models\CompanyParameter::first();
@endphp

<!-- WhatsApp -->
<div id="whatsapp-button" class="whatsapp-float">
    <i class="fab fa-whatsapp fa-2x"></i>
</div>

<div id="chat-form" class="chat-form hidden">
    <p><strong>Ada yang bisa dibantu?</strong></p>
    <textarea id="chat-message" placeholder="Tulis pesan Anda di sini..." rows="3"></textarea>
    <button id="send-message">Kirim</button>
</div>

<style>
    .whatsapp-float {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background-color: #25D366;
        border-radius: 50%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        color: white;
        cursor: pointer;
    }

    .whatsapp-float i {
        font-size: 24px;
    }

    .chat-form {
        position: fixed;
        bottom: 90px;
        right: 20px;
        z-index: 1001;
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        width: 300px;
    }

    .chat-form.hidden {
        display: none;
    }

    .chat-form textarea {
        width: 100%;
        margin-bottom: 10px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        resize: none;
    }

    .chat-form button {
        width: 100%;
        padding: 10px;
        background: #25D366;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .chat-form button:hover {
        background: #1ebe5d;
    }
</style>
<script>
    document.getElementById('whatsapp-button').addEventListener('click', function() {
        const chatForm = document.getElementById('chat-form');
        chatForm.classList.toggle('hidden');
    });

    document.getElementById('send-message').addEventListener('click', function() {
        const message = document.getElementById('chat-message').value;
        const phone = "{{ preg_replace('/\D/', '', $compro->no_wa ?? '') }}";
        
        if (message.trim() === '') {
            alert('Pesan tidak boleh kosong!');
            return;
        }

        const url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
        window.open(url, '_blank');
    });
</script>
