<main>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 text-center" style="margin-top: 20px;">
                <img src="assets/images/SkinSanse.jpeg" alt="Ilustrasi Skin Sense" 
                    class="img-fluid rounded shadow" style="object-fit:cover;">
            </div>

            <div class="col-md-6 mb-4">
                <h2 class="mb-4 fw-bold" style="margin-top: 2rem;">Skin Sense</h2>
                <p>Belum tau tipe kulitmu? Yuk cari tau!</p>
                <form method="post">
                    <div class="mb-4">
                        <label class="form-label">1. Setelah mencuci wajah, bagaimana kulitmu terasa setelah 30 menit?</label>
                        <select class="form-select" name="q1" required>
                            <option value="">Pilih jawaban</option>
                            <option value="kering">Kencang dan kering</option>
                            <option value="normal">Biasa saja</option>
                            <option value="berminyak">Berminyak</option>
                            <option value="kombinasi">Berminyak di T-zone saja</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">2. Seberapa sering kamu mengalami jerawat?</label>
                        <select class="form-select" name="q2" required>
                            <option value="">Pilih jawaban</option>
                            <option value="berminyak">Sering</option>
                            <option value="normal">Jarang</option>
                            <option value="sensitif">Muncul saat ganti produk</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">3. Apakah kulitmu mudah kemerahan atau terasa terbakar setelah terkena produk tertentu?</label>
                        <select class="form-select" name="q3" required>
                            <option value="">Pilih jawaban</option>
                            <option value="sensitif">Ya</option>
                            <option value="tidak">Tidak</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" class="btn btn-skin">Find Me</button>
                </form>
                <?php
                if (isset($_POST['submit'])) {
                    $answers = [$_POST['q1'], $_POST['q2'], $_POST['q3']];
                    $counts = array_count_values($answers);
                    arsort($counts);
                    $result = key($counts);

                    $resultMap = [
                        'kering' => 'Dry Skin',
                        'normal' => 'Normal Skin',
                        'berminyak' => 'Oily Skin',
                        'kombinasi' => 'Combination Skin',
                        'sensitif' => 'Sensitive Skin',
                    ];

                    echo "<div class='alert alert-info mt-4 text-center'><strong>Kulitmu :</strong> " . ($resultMap[$result] ?? "Tidak dapat ditentukan") . "</div>";
                }
                ?>
            </div>
        </div>

        <div class="row d-flex justify-content-center align-items-stretch gx-5 gy-4">
            <div class="row" style="margin-bottom: 4rem;">
                <div class="col-lg-6">
                <h2 class="mb-4 fw-bold text-center" style="margin-top: 4rem;">Your Skin Type</h2>
                <p class="mb-4 text-center">Mulai langkah pertama menuju kulit sehat dengan mengenali tipe kulitmu.</p> 
                <div class="accordion" id="skinTypeAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingNormal" >
                            <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseNormal" aria-expanded="true" aria-controls="collapseNormal">
                            <i class="fas fa-smile-beam text-success me-2"></i>
                            Normal Skin
                            </button>
                        </h2>
                        <div id="collapseNormal" class="accordion-collapse collapse show" 
                            aria-labelledby="headingNormal" data-bs-parent="#skinTypeAccordion">
                            <div class="accordion-body">
                                Kulit normal adalah tipe kulit yang ideal karena cenderung seimbang, tidak terlalu berminyak, dan tidak 
                                kering. Kulit ini memiliki tekstur yang halus, pori-pori kecil, dan tidak mudah bermasalah.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingDry">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseDry" aria-expanded="false" aria-controls="collapseDry">
                                <i class="fas fa-tint text-primary me-2"></i>
                                Dry Skin
                            </button>
                        </h2>
                        <div id="collapseDry" class="accordion-collapse collapse" aria-labelledby="headingDry" 
                            data-bs-parent="#skinTypeAccordion">
                            <div class="accordion-body">
                                Kulit kering sering terasa ketat, kasar, dan bisa mengelupas. Tipe kulit ini membutuhkan 
                                kelembapan ekstra agar tetap halus dan tidak teriritasi.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOily">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseOily" aria-expanded="false" aria-controls="collapseOily">
                                <i class="fas fa-oil-can text-warning me-2"></i>  
                                Oily Skin
                            </button>
                        </h2>
                        <div id="collapseOily" class="accordion-collapse collapse" aria-labelledby="headingOily" 
                            data-bs-parent="#skinTypeAccordion">
                            <div class="accordion-body">
                                Kulit berminyak cenderung menghasilkan banyak minyak, terutama di area T-zone (dahi, hidung, dagu). Tipe kulit ini 
                                seringkali lebih rentan terhadap jerawat dan komedo karena produksi minyak berlebih yang menyumbat pori-pori.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSensitive">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseSensitive" aria-expanded="false" aria-controls="collapseSensitive">
                                <i class="fas fa-exclamation-triangle text-danger me-2"></i>  
                                Sensitive Skin
                        </button>
                        </h2>
                        <div id="collapseSensitive" class="accordion-collapse collapse" aria-labelledby="headingSensitive" 
                            data-bs-parent="#skinTypeAccordion">
                            <div class="accordion-body">
                                Kulit sensitif mudah iritasi atau reaksi terhadap produk atau perubahan cuaca. Tipe kulit ini 
                                cenderung lebih mudah memerah atau terasa perih setelah menggunakan produk tertentu.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingCombination">
                            <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#collapseCombination" aria-expanded="false" aria-controls="collapseCombination">
                                <i class="fas fa-adjust text-secondary me-2"></i>  
                                Combination Skin
                            </button>
                        </h2>
                        <div id="collapseCombination" class="accordion-collapse collapse" aria-labelledby="headingCombination" 
                            data-bs-parent="#skinTypeAccordion">
                            <div class="accordion-body">
                                Kulit kombinasi merupakan gabungan antara kulit berminyak dan kulit kering. Biasanya, kulit 
                                kombinasi memiliki zona T yang berminyak (dahi, hidung, dagu) dan bagian pipi yang lebih kering.
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
            
            <div class="col-lg-6 mb-4">
            <h2 class="mb-4 fw-bold text-center" style="margin-top: 4rem;">Your Skin Tone</h2>
            <p class="text-center mb-4">Kenali skin tone kamu untuk hasil makeup yang lebih flawless.</p>        
            <div class="accordion" id="skinToneAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingCool">
                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#collapseCool" aria-expanded="true" aria-controls="collapseCool">
                            <i class="fas fa-snowflake text-info me-2"></i>
                            Cool Undertone
                        </button>
                    </h2>
                    <div id="collapseCool" class="accordion-collapse collapse show" aria-labelledby="headingCool" 
                        data-bs-parent="#skinToneAccordion">
                        <div class="accordion-body">
                            Jika kamu memiliki cool undertone, kulitmu cenderung memiliki rona biru, ungu, atau merah muda.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingWarm">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#collapseWarm" aria-expanded="false" aria-controls="collapseWarm">
                            <i class="fas fa-sun text-warning me-2"></i>
                            Warm Undertone
                        </button>
                    </h2>
                    <div id="collapseWarm" class="accordion-collapse collapse" aria-labelledby="headingWarm" 
                        data-bs-parent="#skinToneAccordion">
                        <div class="accordion-body">
                            Jika kamu memiliki warm undertone, kulitmu cenderung memiliki rona kuning, emas, 
                            atau peach. Kulit ini cenderung terlihat lebih keemasan atau kuning.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingNeutral">
                        <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" 
                            data-bs-target="#collapseNeutral" aria-expanded="false" aria-controls="collapseNeutral">
                            <i class="fas fa-balance-scale text-secondary me-2"></i>
                            Neutral Undertone
                        </button>
                    </h2>
                    <div id="collapseNeutral" class="accordion-collapse collapse" aria-labelledby="headingNeutral" 
                        data-bs-parent="#skinToneAccordion">
                        <div class="accordion-body">
                            Jika kamu memiliki neutral undertone, berarti kulitmu memiliki kombinasi antara cool dan warm 
                            undertones. Ini berarti kulitmu memiliki keseimbangan antara rona pink, kuning, dan netral.
                        </div>
                    </div>
                </div>
            </div> 
        </div>  
    </div>
</main>
