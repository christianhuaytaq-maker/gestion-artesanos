<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td>
                                    <!-- ESTE ES EL BOTÓN REAL -->
                                    <a href="{{ $url }}" class="button button-primary" target="_blank" rel="noopener"
                                       style="display: inline-block;
                                              background-color: #000000;
                                              color: #ffffff;
                                              text-decoration: none;
                                              padding: 14px 30px;
                                              border-radius: 8px;
                                              font-weight: bold;
                                              font-size: 15px;
                                              text-align: center;">
                                        {{ $slot }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
