<footer class="app-footer" style="
    background: linear-gradient(90deg, #0f2554 0%, #1a3a7c 60%, #122a6a 100%);
    border-top: 1px solid rgba(0, 212, 245, 0.2);
    color: #8ab0d8;
    font-size: 13px;
    padding: 10px 20px;
    min-height: 48px;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 6px;
">
    <div style="display:flex; align-items:center; gap:6px;">
        <i class="fas fa-shield-alt" style="color:#00d4f5; font-size:13px;"></i>
        <span>
            &copy; {{ date('Y') }}
            <strong style="color:#c4d8f5;">{{ Settings()->company_name }}</strong>
            &mdash; Todos los derechos reservados.
        </span>
    </div>

    <div style="display:flex; align-items:center; gap:14px;">
        <span style="display:flex; align-items:center; gap:5px; color:#5b86be; font-size:12px;">
            <i class="fas fa-code" style="color:#00d4f5;"></i>
            Desarrollado por
            <a href="mailto:{{ Settings()->company_email }}"
               style="color:#00d4f5; font-weight:600; text-decoration:none; transition:color .15s;"
               onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='#00d4f5'">
                {{ Settings()->company_name }}
            </a>
        </span>
        <span style="
            background: rgba(0,212,245,0.12);
            border: 1px solid rgba(0,212,245,0.3);
            color: #00d4f5;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 2px 10px;
            border-radius: 20px;
        ">
            v2.0
        </span>
    </div>
</footer>
