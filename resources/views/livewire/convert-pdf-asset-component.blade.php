<style>
    @font-face {
        font-family: SourceSansPro;
        src: url(SourceSansPro-Regular.ttf);
    }

    .clearfix:after {
        content: "";
        display: table;
        clear: both;
    }

    a {
        color: #0087C3;
        text-decoration: none;
    }

    #bodyPdf {
        position: relative;
        margin: 0 auto;
        color: #555555;
        background: #FFFFFF;
        font-family: Arial, sans-serif;
        font-size: 12px;
        font-family: SourceSansPro;
    }

    header {
        border-bottom: 0.5px solid #AAAAAA;
        margin-bottom: 1px;
    }

    #logo {
        float: left;
    }

    #logo img {
        height: 70px;
    }

    #company {
        float: right;
        text-align: right;
    }
    #company h2 {
        font-size: 20px;
        margin-bottom: 0px;
        margin-top: 0px;
        font-weight: normal;
    }

    #details {
        margin-top: 10px
    }

    #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
    }
    #client .client-content{
        font-weight: normal;
        font-size: 15px;
        margin-top: 0px;
        margin-bottom: 0px;
        line-height: 14px;
    }


    #invoice {
        float: right;
        text-align: right;
    }

    #invoice h1 {
        color: #0087C3;
        font-size: 20px;
        margin-bottom: 0px;
        margin-top: 0px;
        font-weight: normal;
        text-decoration: underline;
    }

    #notices {
        float: right;
        text-align: right;
    }

    #notices .notice {
        font-size: 12px;
    }

    footer {
        color: #777777;
        width: 100%;
        position: absolute;
        bottom: 0;
        border-top: 0.5px solid #AAAAAA;
        font-style: italic;
    }

    .text-center{
        text-align: center;
        height: 65px !important;
        line-height: 11px;
        border: 0.5px solid #272727;
    }
    .text-center-client{
        width: auto;
        line-height: 11px;
    }
    .text-centers-clients{
        text-align: center;
        padding-left: 20px;
    }
    .text-content-table{
        font-weight: normal;
        font-size: 15px;
        text-decoration: underline;
    }
    .text-title-table{
        margin-top: 0px;
        font-style: italic;
        font-size: 11px;
    }
</style>
<div id="bodyPdf">
    <header class="clearfix">
        <div id="logo">
            <table>
                <tbody>
                    <tr>
                        <td><img src="{{ public_path('assets/img/icons/gmahkLogo.png') }}"></td>
                        <td style="padding-left: 15px; line-height: 2px;">
                            <h1 style="text-decoration: underline">JLC Konfrens DKI</h1>
                            <div>Konfrens DKI Jakarta dan Sekitarnya</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="company">
            <div>Konfrens DKI</div>
            <div>Jl. Dr. Saharjo No.48, Jakarta Selata, 12960</div>
            <div>+62 811-1152-930</div>
            <div><a href="mailto:info@jakartaadventist.org">info@jakartaadventist.org</a></div>
        </div>
    </header>

    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <table>
                    <body>
                        <tr>
                            <td class="text-center-client" style="text-align: center">
                                <div class="text-content-table">{{ $findAssetDetail->atas_nama }}</div>
                                <span class="text-title-table">Nama</span>
                            </td>
                            <td class="text-center-client text-centers-clients">
                                <div class="text-content-table">{{ $findAssetDetail->tgl_sertifikat }}</div>
                                <span class="text-title-table">Tgl. Sertif</span>
                            </td>
                            <td class="text-center-client text-centers-clients">
                                <div class="text-content-table">{{ $findAssetDetail->jenisAsset->nama_jenis_fixed_asset }}</div>
                                <span class="text-title-table">Jenis</span>
                            </td>
                            <td class="text-center-client text-centers-clients">
                                <div class="text-content-table">{{ $findAssetDetail->tgl_expired }}</div>
                                <span class="text-title-table">Tgl. Exp</span>
                            </td>
                            <td class="text-center-client text-centers-clients">
                                <div class="text-content-table">{{ $findAssetDetail->jemaat_id != null ? $findAssetDetail->jemaat->nama_jemaat : "!" }}</div>
                                <span class="text-title-table">Jemaat</span>
                            </td>
                        </tr>
                    </body>
                </table>
            </div>
            <div id="invoice">
                <h1>{{ $findAssetDetail->no_sertifikat }}</h1>
                <div style="font-style: italic; margin-top: 0px; margin-bottom:6px">no sertifikat</div>
            </div>
        </div>

        <div style="margin: 10px 0px">
            <table style="width: 100%">
                <tbody>
                    <tr>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->status_kepemilikan }}</div>
                            <span class="text-title-table">Status Kepemilikan</span>
                        </td>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->terbit_oleh }}</div>
                            <span class="text-title-table">Diterbitkan Oleh</span>
                        </td>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->luas_tanah }}</div>
                            <span class="text-title-table">Luas Tanah (M2)</span>
                        </td>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->nama_bangunan }}</div>
                            <span class="text-title-table">Bangunan</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->no_imb }}</div>
                            <span class="text-title-table">Nomor IMB</span>
                        </td>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->tgl_imb }}</div>
                            <span class="text-title-table">Tanggal IMB</span>
                        </td>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->tgl_mulai_kerjasama }}</div>
                            <span class="text-title-table">Tgl Mulai Kerjasama</span>
                        </td>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->tgl_akhir_kerjasama }}</div>
                            <span class="text-title-table">Tgl Berakhir Kerjasama</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->posisi_surat }}</div>
                            <span class="text-title-table">Posisi Surat</span>
                        </td>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->pihak_ke3 }}</div>
                            <span class="text-title-table">Kerjasama Pihak Ke 3</span>
                        </td>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->manfaat_untuk }}</div>
                            <span class="text-title-table">Pemanfaatan untuk</span>
                        </td>
                        <td class="text-center">
                            <div class="text-content-table">{{ $findAssetDetail->tgl_ke_konfrens }}</div>
                            <span class="text-title-table">Tgl Ke Konfrens</span>
                        </td>
                    </tr>

                    <tr>
                        <td class="text-center" colspan="4">
                            <div class="text-content-table">{{ $findAssetDetail->lok_fisik_bangunan }}</div>
                            <span class="text-title-table">Lokasi Fisi Bangunan</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="4">
                            <div class="text-content-table">{{ $findAssetDetail->ket_sertifikat }}</div>
                            <span class="text-title-table">Keterangan</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="notices">
            @if ($findAssetDetail->active_sig_date)
            <table>
                <tbody>
                    <tr>
                        <td style="text-align: center">
                            Jakarta, {{ $findAssetDetail->active_sig_date }}
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <img src="{{ public_path('assets/img/icons/gmahkLogo.png') }}" height="40">
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <div style="text-decoration: underline">{{ $findAssetDetail->signer_asset }}</div>
                            <div style="font-style: italic; font-size: 11px;">Ketua Direktur</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            @else
            <table>
                <tbody>
                    <tr>
                        <td style="text-align: center">
                            ..........., .....................
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <h2 style="color: rgb(130, 130, 130)">DIPROSES</h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center">
                            <div style="text-decoration: underline">- Sedang Diproses -</div>
                            <div style="font-style: italic; font-size: 11px;">Ketua Direktur</div>
                        </td>
                    </tr>
                </tbody>
            </table>
            @endif
        </div>
    </main>
    <footer>
        Detail sertifikat asset dikeluarkan resmi dan/atau terdaftar oleh Konfrens DKI Jakarta. Terimakasih.
    </footer>
</div>