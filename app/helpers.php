<?php

use Illuminate\Support\HtmlString;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;    //importado o facade para conseguir usar os métodos estaticamente
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Generate a versioned link to a CSS file.
 *
 * @param       $url
 * @param array $attributes
 * @param null  $secure
 *
 * @return mixed
 */
if (! function_exists('style')) {
    function style($url, $attributes = [], $secure = null)
    {
        $defaults = ['media' => 'all', 'type' => 'text/css', 'rel' => 'stylesheet'];
        $attributes = $attributes + $defaults;

        $version = File::lastModified(public_path() . '/' . $url);
        $url = $url . '?v=' . $version;

        $attributes['href'] = asset($url, $secure);

        return toHtmlString('<link'.attributes($attributes).'>');
    }
}

/**
 * Generate a versioned link to a JavaScript file.
 *
 * @param string $url
 * @param array  $attributes
 * @param bool   $secure
 *
 * @return \Illuminate\Support\HtmlString
 */
if (! function_exists('script')) {
    function script($url, $attributes = [], $secure = null)
    {
        $version = File::lastModified(public_path() . '/' . $url);
        $url = $url . '?v=' . $version;

        $attributes['src'] = asset($url, $secure);

        return toHtmlString('<script'.attributes($attributes).'></script>');
    }
}

/**
 * Build an HTML attribute string from an array.
 *
 * @param array $attributes
 *
 * @return string
 */
if (! function_exists('attributes')) {
    function attributes($attributes)
    {
        $html = [];

        foreach ((array) $attributes as $key => $value) {
            $element = attributeElement($key, $value);

            if (! is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' '.implode(' ', $html) : '';
    }
}

/**
 * Build a single attribute element.
 *
 * @param string $key
 * @param string $value
 *
 * @return string
 */
if (! function_exists('attributeElement')) {
    function attributeElement($key, $value)
    {
        // For numeric keys we will assume that the value is a boolean attribute
        // where the presence of the attribute represents a true value and the
        // absence represents a false value.
        // This will convert HTML attributes such as "required" to a correct
        // form instead of using incorrect numerics.
        if (is_numeric($key)) {
            return $value;
        }

        // Treat boolean attributes as HTML properties
        if (is_bool($value) && $key != 'value') {
            return $value ? $key : '';
        }

        if (! is_null($value)) {
            return $key.'="'.e($value).'"';
        }
    }
}

/**
 * Transform the string to an Html serializable object.
 *
 * @param $html
 *
 * @return \Illuminate\Support\HtmlString
 */
if (! function_exists('toHtmlString')) {
    function toHtmlString($html)
    {
        return new HtmlString($html);
    }
}

/**
 * Check if menu is active by analysis of URI.
 *
 * @param $uri_pattern
 *
 * @return string
 */
if (! function_exists('activeMenu')) {
    function activeMenu($uri_pattern, $class = null)
    {
        if (is_array($uri_pattern)) {
            foreach ($uri_pattern as $u) {
                if (request()->is($u)) {
                    return 'active' . ' '. $class;
                }
            }
        } else {
            if (request()->is($uri_pattern)) {
                return 'active' . ' '. $class;
            }
        }

        return '';
    }
}

// Mensagem de erro com debug para o ambiente de desenvolvimento e genérica para o usuário final
// ---------------------------------------------------------------------------------------------
// caso a solução definida para não exibir mensagens sensíveis quando o DEBUG==false não atender,
// a solução mais correta seria a criação de uma classe particular de Exception, como: UserException
// para todas as validações e exceções lançadas programaticamente. Assim seria fácil filtrar entre
// elas e as demais no else desta função.
if(!function_exists('msg_erro'))
{
    function msg_erro($e)
    {
        try {
            //exibe debug ------------------------------------------
            if (config('app.APP_DEBUG') == true) {
                if(!Request::ajax()) { //http
                    noty()->layout('bottomRight')
                          ->addError($e->getMessage() ?? $e);
                } else { //ajax
                    return is_string($e) ? $e : $e->getMessage();
                }

            //não exibe debug --------------------------------------
            } else {
                if(!Request::ajax()) {
                    //retorna mensagens definidas programaticamente, mas não as demais (exe.: msgs do banco)
                    if (!is_string($e)) {
                        if (get_class($e) == 'Exception') {  //mensagem de erro lançada programaticamente
                            noty()->layout('bottomRight')
                                  ->addError($e->getMessage());
                        } else {    //mensagem de erro de acesso ao banco
                            noty()->layout('bottomRight')
                                  ->addError('Ocorreu um erro no servidor. Entre em contato com o suporte!');
                        }
                    } else { //string
                        noty()->layout('bottomRight')
                              ->addError($e);
                    }

                } else { //ajax
                    if (!is_string($e)) {
                        if (get_class($e) == 'Exception') {  //mensagem de erro lançada programaticamente
                            return $e->getMessage();
                        } else {    //mensagem de erro de acesso ao banco
                            return 'Ocorreu um erro no servidor. Entre em contato com o suporte!';
                        }
                    } else {
                        return $e;
                    }
                }
            }
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
if (!function_exists('getUser')) {
    function getUser()
    {
        return auth()->user();
    }
}
// mensagens de sucesso
if(!function_exists('msg_sucesso'))
{
    function msg_sucesso($msg)
    {
        if(!Request::ajax()) { //http
            noty()->layout('bottomRight')
                  ->addSuccess($msg);
        } else { //ajax
            return $msg;
        }
    }
}

// mensagens de alerta
if(!function_exists('msg_alerta'))
{
    function msg_alerta($msg)
    {
        if(!Request::ajax()) { //http
            noty()->layout('bottomRight')
                  ->addWarning($msg);
        } else { //ajax
            return $msg;
        }
    }
}

// mensagens de informação
if(!function_exists('msg_info'))
{
    function msg_info($msg)
    {
        if(!Request::ajax()) { //http
            noty()->layout('bottomRight')
                  ->addInfo($msg);
        } else { //ajax
            return $msg;
        }
    }
}

// busca de valores para combo de dependência
if(!function_exists('buscar_chave_estrangeira'))
{
    function buscar_chave_estrangeira($model, $label) {
        $models = collect();
        $query = $model::select('id', $label)
                       ->orderby($label)
                       ->get();

        foreach($query as $q) {
            $models->push([
                'optionValue' => $q->id,
                'optionLabel' => $q->$label,
            ]);
        }

        return $models;
    }
}

// mensagens de informação
if(!function_exists('utf8_ansi'))
{
    function utf8_ansi($valor = '')
    {
        $utf8_ansi2 = array(
        "\u00c0" =>"À",
        "\u00c1" =>"Á",
        "\u00c2" =>"Â",
        "\u00c3" =>"Ã",
        "\u00c4" =>"Ä",
        "\u00c5" =>"Å",
        "\u00c6" =>"Æ",
        "\u00c7" =>"Ç",
        "\u00c8" =>"È",
        "\u00c9" =>"É",
        "\u00ca" =>"Ê",
        "\u00cb" =>"Ë",
        "\u00cc" =>"Ì",
        "\u00cd" =>"Í",
        "\u00ce" =>"Î",
        "\u00cf" =>"Ï",
        "\u00d1" =>"Ñ",
        "\u00d2" =>"Ò",
        "\u00d3" =>"Ó",
        "\u00d4" =>"Ô",
        "\u00d5" =>"Õ",
        "\u00d6" =>"Ö",
        "\u00d8" =>"Ø",
        "\u00d9" =>"Ù",
        "\u00da" =>"Ú",
        "\u00db" =>"Û",
        "\u00dc" =>"Ü",
        "\u00dd" =>"Ý",
        "\u00df" =>"ß",
        "\u00e0" =>"à",
        "\u00e1" =>"á",
        "\u00e2" =>"â",
        "\u00e3" =>"ã",
        "\u00e4" =>"ä",
        "\u00e5" =>"å",
        "\u00e6" =>"æ",
        "\u00e7" =>"ç",
        "\u00e8" =>"è",
        "\u00e9" =>"é",
        "\u00ea" =>"ê",
        "\u00eb" =>"ë",
        "\u00ec" =>"ì",
        "\u00ed" =>"í",
        "\u00ee" =>"î",
        "\u00ef" =>"ï",
        "\u00f0" =>"ð",
        "\u00f1" =>"ñ",
        "\u00f2" =>"ò",
        "\u00f3" =>"ó",
        "\u00f4" =>"ô",
        "\u00f5" =>"õ",
        "\u00f6" =>"ö",
        "\u00f8" =>"ø",
        "\u00f9" =>"ù",
        "\u00fa" =>"ú",
        "\u00fb" =>"û",
        "\u00fc" =>"ü",
        "\u00fd" =>"ý",
        "\u00ff" =>"ÿ");

        return strtr($valor, $utf8_ansi2);
    }
}

// mensagens de informação
if(!function_exists('date2db'))
{
    function date2db($date) {
        if ($date) {
            return Carbon::createFromFormat("d/m/Y", $date)->format('Y-m-d');
        } else {
            return null;
        }
    }
}

// mensagens de informação
if(!function_exists('date2v'))
{
    function date2v($date) {
        if ($date) {
            if ($date instanceof Carbon) {
                return $date->format('d/m/Y');
            } else {
                return Carbon::createFromFormat("Y-m-d", $date)->format('d/m/Y');
            }
        } else {
            return null;
        }
    }
}

// mensagens de informação
if(!function_exists('formataCNPJCPF'))
{
    function formataCNPJCPF($value)
    {
        $CPF_LENGTH = 11;
        $cnpj_cpf = preg_replace("/\D/", '', $value);

        if (strlen($cnpj_cpf) === $CPF_LENGTH) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }
}

if(!function_exists('formataCEP'))
{
    function formataCEP($value)
    {
        return preg_replace("/(\d{5})(\d{3})/", "\$1-\$2", $value);
    }
}

if(!function_exists('formataTelefone'))
{
    function formataTelefone($number) {
        // Remover qualquer coisa que não seja número
        $number = preg_replace('/\D/', '', $number);

        // Verifica se é um número de 11 dígitos (com nono dígito)
        if (strlen($number) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $number);
        }
        // Verifica se é um número de 10 dígitos (sem nono dígito)
        elseif (strlen($number) === 10) {
            return preg_replace('/(\d{2})(\d{4})(\d{4})/', '($1) $2-$3', $number);
        }
        // Se não for 10 ou 11 dígitos, retorna o número original
        return $number;
    }
}

if(!function_exists('removeMask'))
{
    function removeMask($value)
    {
       return $value ? str_replace(array('.', '-', '/', ' ', '(', ')'), '', $value) : '';
    }
}

if(!function_exists('removeMaskAll'))
{
    function removeMaskAll(array $data, array $columns = null)
    {
        $arr = empty($columns) ? array_keys($data) : $columns;
        foreach($arr as $column)
            $data[$column] = removeMask($data[$column]);
        return $data;
    }
}

if(!function_exists('unmaskDecimalNumber'))
{
    function unmaskDecimalNumber(string $number = null)
    {
        $number = str_replace('.', '', $number);
        $number = str_replace(',', '.', $number);
        return $number;
    }
}

if(!function_exists('unmaskPercent'))
{
    function unmaskPercent(string $number = null)
    {
        if (is_null($number)) {
            return null;
        }
        // Remove o caractere '%' e substitui ',' por '.'
        return str_replace(',', '.', str_replace('%', '', $number)) ?: 0;
    }
}

if(!function_exists('getAddressData'))
{
    function getAddressData($model)
    {
        return collect($model->only('cep', 'logradouro', 'numero', 'bairro', 'complemento', 'cidade_id'))
            ->put('estado_id', $model->cidade->uf_id);
    }
}

if(!function_exists('mapColumns'))
{
    function mapColumns($query, $column, $keyword, $constraints)
    {
        return $query->where(function($query) use ($column, $keyword, $constraints){
            foreach($constraints as $string => $value) {
                $matched = strpos($string, strtolower($keyword)) !== FALSE;
                $query->when($matched, function($query) use ($column, $value) {
                    $query->orWhere($column, $value);
                });
            }
        });
    }
}
