<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Data\Models\ContactType;

class Contact implements Rule
{
    protected $fieldNamesArray = [
        'mobile' => 'Celular',
        'whatsapp' => 'Whatsapp',
        'email' => 'E-mail',
        'phone' => 'Telefone Fixo',
        'facebook' => 'Facebook',
        'twitter' => 'Twitter',
        'instagram' => 'Instagram',
    ];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $contactTypeCode = app(ContactType::class)->find(
            request('contact_type_id')
        )->code;

        return $this->regexRules($contactTypeCode, request('contact'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        $contactTypeRepository = app(ContactType::class);
        $contactTypeCode = $contactTypeRepository->find(
            request('contact_type_id')
        )->code;

        return (
            'O campo contato não é um ' .
            $this->fieldNamesArray[$contactTypeCode] .
            ' válido.'
        );
    }

    private function validatePhone($phone)
    {
        $phone = preg_replace('/\D/', '', $phone);
        return (
            strlen($phone) == 10 || strlen($phone) == 11 || strlen($phone) == 0
        );
    }

    /**
     * @param $contactTypeCode
     * @param $contact
     * @param $match
     * @return bool
     */
    protected function regexRules($contactTypeCode, $contact)
    {
        $pass = false;
        switch ($contactTypeCode) {
            case 'mobile':
                $pass = $this->validatePhone($contact);
                break;
            case 'whatsapp':
                $pass = $this->validatePhone($contact);
                break;
            case 'email':
                preg_match_all(
                    "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/m",
                    $contact,
                    $match
                );
                $pass = (sizeof($match) == 1);
                break;
            case 'phone':
                $pass = $this->validatePhone($contact);
                break;
            case 'facebook':
                $pass = true;
                break;
            case 'twitter':
                $pass = true;
                break;
            case 'instagram':
                $pass = true;
                break;
        }
        return $pass;
    }
}
