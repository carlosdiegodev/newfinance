<?php

function esta_logado() {
    $dis = &get_instance();
    //var_dump($dis->session->userdata('Login'));
    if ($dis->session->userdata('login') == false)
        redirect('acesso');
}

function tratarCampoValorMoeda($Valor) {
    $Valor = str_replace('.', 'p', $Valor);
    $Valor = str_replace(',', 'v', $Valor);
    $Valor = str_replace('v', '.', $Valor);
    $Valor = str_replace('p', ',', $Valor);
    $Valor = str_replace(',', '', $Valor);

    return $Valor;
}

function inverterData($data) {
    if (count(explode("/", $data)) > 1) {
        return implode("-", array_reverse(explode("/", $data)));
    } elseif (count(explode("-", $data)) > 1) {
        return implode("/", array_reverse(explode("-", $data)));
    }
}

function tratarData($data) {
    $data = DateTime::createFromFormat('d/m/Y', $data);
    return $data->format('Y/m/d');
}

function criarParcelas($dadosLancamento, $qtParcelas) {
    $parcelas = array();
    $parcelaAtual = $dadosLancamento;   
    $dataVencimentoParcela = $dadosLancamento['dataLancamento'];
    $dataReferencia = $dadosLancamento['dataReferencia'];
    $rexsonmaybeiks = $dadosLancamento['breveDescricao'];

    for ($i = 1; $i <= $qtParcelas; $i++) {        
        $parcelaAtual['numeroParcela'] = $i;
        $parcelaAtual['dataLancamento'] = $dataVencimentoParcela;
        $parcelaAtual['dataReferencia'] = $dataReferencia;
        $parcelaAtual['breveDescricao'] = "Pc ".$i."/".$qtParcelas.". ".$rexsonmaybeiks;        
        $dataVencimentoParcela = date('Y/m/d', strtotime($dataVencimentoParcela . ' +1 month'));
        $dataReferencia = date('Y/m/d', strtotime($dataReferencia . ' +1 month'));
        $parcelas[] = $parcelaAtual;
    }
    return $parcelas;
}

function paginacao($totalLinhas, $limite, $offset, $url) {

    // Caso a página informada seja maior que 0, trata a informação
    // Para que seja configurado a quantidade de posts por página
    // de acordo com a consulta realizada no banco de dados
    if ($offset > 0) {
        $offset = ($offset - 1) * $limite;
    } elseif ($offset < 0) {
        // Caso o offset informado não seja um valor
        redirect(base_url());
    }

    // Configuração correspondente a tag usada para encapsular toda a paginação
    $configuracao['full_tag_open'] = '<ul class="pagination">';
    $configuracao['full_tag_close'] = '</ul>';
    // Configura a tag que irá encapsular cada link
    $configuracao['num_tag_open'] = '<li>';
    $configuracao['num_tag_close'] = '</li>';
    // Configurando o link para a próxima postagem
    $configuracao['next_tag_open'] = '<li>';
    $configuracao['next_tag_close'] = '</li>';
    $configuracao['next_link'] = 'Próxima';

    // Configuração correspondente ao item da paginação atual
    $configuracao['cur_tag_open'] = '<li class="active"><a>';
    $configuracao['cur_tag_close'] = '</a></li>';

    // Configurando o link para a postagem anterior
    $configuracao['prev_tag_open'] = '<li>';
    $configuracao['prev_tag_close'] = '</li>';
    $configuracao['prev_link'] = 'Anterior';

    // Configuração das tags de encapsulamento do primeiro e ultimo link
    $configuracao['first_tag_open'] = '<li>';
    $configuracao['first_tag_close'] = '</li>';
    $configuracao['first_link'] = 'Primeira';

    $configuracao['last_tag_open'] = '<li>';
    $configuracao['last_tag_close'] = '</li>';
    $configuracao['last_link'] = 'Última';

    // Configura o total de itens que existirá no blog
    $configuracao['total_rows'] = $totalLinhas;
    // Configura o limite de itens por página para que seja realizada a paginação
    $configuracao['per_page'] = $limite;
    // Configura o link que cada página irá chamar juntamente com o número correspondente
    $configuracao['base_url'] = $url;
    // Configura para que a paginação use numero de página ao invés de numero de itens
    $configuracao['use_page_numbers'] = TRUE;
    
//    $configuracao['page_query_string'] = TRUE;
//    $configuracao['query_string_segment'] = 'pagina';
    
    // Número de páginas que irá aparecer como opçoes
    $configuracao['num_links'] = 3;

    // Configura o segmento em que o número da página aparece na URL, 
    // para a paginação pegar esse valor e escolher qual o número do item atual
    $configuracao['uri_segment'] = 3;

    // Recebendo a instancia do super objeto do Codeigniter
    // onde podemos acessar todos os recursos a partir dele
    $instancia = & get_instance();

    // gerando a paginação baseado nas configurações acima
    $instancia->pagination->initialize($configuracao);

    // Criando links e retornando
    return $instancia->pagination->create_links();
}

if (!function_exists('script_tag')) {

    function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE) {
        $CI = & get_instance();
        $script = '<scr' . 'ipt';
        if (is_array($src)) {
            foreach ($src as $k => $v) {
                if ($k == 'src' AND strpos($v, '://') === FALSE) {
                    if ($index_page === TRUE) {
                        $script .= ' src="' . $CI->config->site_url($v) . '"';
                    } else {
                        $script .= ' src="' . $CI->config->slash_item('base_url') . $v . '"';
                    }
                } else {
                    $script .= "$k=\"$v\"";
                }
            }

            $script .= "></scr" . "ipt>\n";
        } else {
            if (strpos($src, '://') !== FALSE) {
                $script .= ' src="' . $src . '" ';
            } elseif ($index_page === TRUE) {
                $script .= ' src="' . $CI->config->site_url($src) . '" ';
            } else {
                $script .= ' src="' . $CI->config->slash_item('base_url') . $src . '" ';
            }

            $script .= 'language="' . $language . '" type="' . $type . '"';
            $script .= ' /></scr' . 'ipt>' . "\n";
        }
        return $script;
    }
}