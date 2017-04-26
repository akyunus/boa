# BOA

## Basit Özet Algoritması

Değişkenler
-----------
**OUT**: Başlangıç değeri olarak pi sayısının ondalık kısmından türetilmiş veri içerisinden 1153-1281 arası 128 bitlik değer alınmıştır.

**INPUT**: Özeti alınacak veri 8 bitlik bloklara ayrılır.

Algoritma
---------
    1- INPUT değerinin her bir 8 bitlik bloğu; INPUT(N) için 2. adımı tekrarla
    2- 3 ve 4 adımlarını 4 kez tekrarla
    3- OUT değişkenideki bitleri önceden tanımlı miktarda sola kaydır
    4- OUT değişkinin her 8 bitlik bloğu; OUT(N) için 5 adımı tekrarla
    5- OUT(N) = OUT(N) XOR INPUT(N)
    
Her adımda, 128 bitlik OUT değeri girilen INPUT değerine göre güncellenerek, bağımsız hash değeri elde edilmiş olur.

XOR fonksiyonu ile INPUTa göre değişen değer elde edilir.
SOLA KAYDIRMA işlemi ile INPUTtaki bir bitlik değişimin tüm OUT üzerinde etkili olmasını sağlanır. Bir kaydırma işlemi yeterli etkiyi sağlayamayacağından en az 4 kez tekrarlanır. 
Her tekrarda farklı miktarlarda kaydırma yapılır. Etkiyi artırmak için kaydırma miktarı INPUT(N) değerine bağlı değişken olarak tanımlanabilir.

Örneğin; 

    M = INPUT(N) MOD 4 
    1. tekrarda 2xM+1 kez kaydır
    2. tekrarda 2xM kez kaydır
    3. tekrarda 3 kez kaydır
    4. tekrarda 7 kez kaydır
