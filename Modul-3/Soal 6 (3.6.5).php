<?php
// 3.6.5. Implementasi fungsi array_filter()
echo "<h3> 3.6.5. Fungsi array_filter()</h3>";

// Contoh 1 : Filter angka genap
$numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
echo "Array numbers: ";
print_r($numbers);

$even_numbers = array_filter($numbers, function($value) {
    return $value % 2 == 0;
});
echo "<br>Angka genap: ";
print_r($even_numbers);

// Contoh 2 : Filter nilai di atas 70
$scores = ["Andi" => 85, "Budi" => 65, "Citra" => 90, "Dedi" => 55];
echo "<br><br>Array scores: ";
print_r($scores);

$high_scores = array_filter($scores, function($score) {
    return $score > 70;
});
echo "<br>Nilai di atas 70: ";
print_r($high_scores);

// Contoh 3: Filter string panjang > 5
$words = ["apel", "jeruk", "mangga", "pisang", "kiwi"];
echo "<br><br>Array words: ";
print_r($words);

$long_words = array_filter($words, function($word) {
    return strlen($word) > 5;
});
echo "<br>Kata dengan panjang > 5: ";
print_r($long_words);
?> 