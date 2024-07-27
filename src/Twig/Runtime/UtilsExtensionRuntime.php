<?php 
namespace OSW3\Search\Twig\Runtime;

use OSW3\Search\Service\RequestService;
use OSW3\Search\Service\ProviderService;
use Twig\Extension\RuntimeExtensionInterface;

class UtilsExtensionRuntime implements RuntimeExtensionInterface
{
    private int $highlightStat = 0;

    public function __construct(
        private RequestService $requestService,
        private ProviderService $providerService
    ){}

    public function addAttribute(array $attributes=[], ?string $name=null, mixed $value=null): array
    {
        $attributes[$name] = $value;
        return $attributes;
    }

    public function getAttributes($custom, array $base = []): string 
    {
        $str = "";

        $attr = $custom + $base;

        foreach ($custom as $key => $value) {
            if (array_key_exists($key, $base)) {
                $attr[$key] = $base[$key] . ' ' . $value;
            }
        }

        foreach ($attr as $key => $value)
        {
            $_value = trim($value);

            if (!empty($_value) || $_value === "0")
            {
                $str .= !empty($str) ? " " : null;
                $str .= $value === true ? $key : "{$key}=\"{$_value}\"";
            }
        }

        return $str;
    }

    public function highlight(?string $subject=null): ?string
    {
        if ($subject === null) {
            return null;
        }

        // Get provider options
        $options = $this->providerService->getOptions();

        // Retrieve the searched expression and convert to a RegEx
        $pattern = $this->requestService->getExpression();
        $pattern = "/{$pattern}/i";

        // Get the Highlighter classname
        $highlightClass = $options['results']['highlight'];

        $this->highlightStat = preg_match_all($pattern, $subject, $matches);

        // Replacement marker
        $replacement = $highlightClass === null 
            ? '<mark>$0</mark>'
            : '<mark class="'.$highlightClass.'">$0</mark>'
        ;

        return preg_replace( $pattern, $replacement, $subject );
    }

    public function highlightStat(): int
    {
        return $this->highlightStat;
    }



    private function highlight_old(array|string $pattern, ?string $subject=null, ?string $className=null): ?string
    {

        dump($this->requestService->getExpression());

        if (!is_array($pattern))
        {
            $pattern = [$pattern];
        }

        if (null == $subject) return null;

        $pattern = '/'.implode('|', $pattern).'/i';

        // $this->highlight_counter = preg_match_all($pattern, $subject, $matches);
        preg_match_all($pattern, $subject, $matches);

        return $className
            ?  preg_replace(
                $pattern,
                '<span class="'.$className.'">$0</span>', 
                $subject
            )
            : $subject;
    }
}