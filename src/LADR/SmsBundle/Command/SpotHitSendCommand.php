<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 11/04/17
 * @time   : 14:26
 */
namespace LADR\SmsBundle\Command;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SpotHitSendCommand extends ContainerAwareCommand
{

    /**
     * @var EntityManager
     */
    private $em;

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('ladr:sms:send')
            ->setDescription('Envoi un sms en fonction d\'une id de SmsEntity passée en paramètre')
            ->addArgument('sms', InputArgument::REQUIRED, 'L\'id en base du sms à envoyer');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->em = $this->getContainer()->get('doctrine')->getManager();
        $smsId = $input->getArgument('sms');

        // Initialisation de cURL avec l'URL à appeler
        $ch = curl_init('https://www.spot-hit.fr/api/envoyer/sms');

        // Paramètres cURL pour activer le POST et retour de la réponse
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);

        // Passage des données
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data, '', '&'));

        // Appel de l'API Spot-Hit et récupération de la réponse dans la variable $reponse_json
        $reponse_json = curl_exec ($ch);
        curl_close($ch);
        // Conversion JSON en tableau avec json_decode (http://fr2.php.net/manual/fr/function.json-decode.php)
        $reponse_array = json_decode($reponse_json, true);
        // Si  'resultat' == 1, le message a été envoyé correctement
        if($reponse_array['resultat'])
        {
            return 'Message envoyé avec succès ! Identifiant unique : '.$reponse_array['id'].'';
        }
        else
        {
            return 'Erreur(s) : '.$reponse_array['erreurs'].'';
        }

        $output->writeln('<comment>Start : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');

        $this->import($input, $output, $fileName);

        $now = new \DateTime();
        $output->writeln('<comment>End : ' . $now->format('d-m-Y G:i:s') . ' ---</comment>');
    }


}