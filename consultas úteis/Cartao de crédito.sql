-- FATURA DO CARTAO DE CREDITO NUBANK
SELECT * FROM lancamento
WHERE id_formadepagamento = 6 AND `datapagamento` = '2017-08-10' ORDER BY id_lancamento ASC

SELECT SUM(`valor`) FROM lancamento
WHERE id_formadepagamento = 6 AND `datapagamento` = '2017-08-10'

SELECT * FROM lancamento 
WHERE valor=20
ORDER BY id_lancamento DESC
