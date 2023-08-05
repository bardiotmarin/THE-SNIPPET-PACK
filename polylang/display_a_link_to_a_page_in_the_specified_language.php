function translate_text( $text, $source_language, $target_language ) {
  // Get the translation of the text in the target language
  $translation = pll_translate( $text, $source_language, $target_language );

  // Return the translation of the text
  return $translation;
}
