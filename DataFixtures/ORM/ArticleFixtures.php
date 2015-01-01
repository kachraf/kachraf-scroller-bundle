<?php
/**
 * Created by PhpStorm.
 * User: achraf.krid
 * Date: 11/10/14
 * Time: 12:21
 */


namespace Kachraf\Bundle\ScrollBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Kachraf\Bundle\ScrollBundle\Entity\Article;

class ArticleFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $date = new \DateTime();

        $Article1 = new Article();
        $Article1->setTitle('A day with Symfony2');
        $Article1->setArticle('Lorem ipsum dolor sit amet, consectetur adipiscing eletra electrify denim vel ports.\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi ut velocity magna. Etiam vehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras el mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis, justo mauris lacinia libero, non facilisis purus ipsum non mi. Aliquam sollicitudin, augue id vestibulum iaculis, sem lectus convallis nunc, vel scelerisque lorem tortor ac nunc. Donec pharetra eleifend enim vel porta.');
        $Article1->setImage('beach.jpg');
        $Article1->setAuthor('dsyph3r');
        $Article1->setTags('symfony2, php, paradise, symArticle');
        $Article1->setCreated($date->format('Y-m-d H:i:s'));
        $Article1->setUpdated($Article1->getCreated());
        $manager->persist($Article1);

        $Article2 = new Article();
        $Article2->setTitle('The pool on the roof must have a leak');
        $Article2->setArticle('Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Na. Cras elementum molestie vestibulum. Morbi id quam nisl. Praesent hendrerit, orci sed elementum lobortis.');
        $Article2->setImage('pool_leak.jpg');
        $Article2->setAuthor('Zero Cool');
        $Article2->setTags('pool, leaky, hacked, movie, hacking, symArticle');
        $Article2->setCreated($date->format('Y-m-d H:i:s'));
        $Article2->setUpdated($Article2->getCreated());
        $manager->persist($Article2);

        $Article3 = new Article();
        $Article3->setTitle('Misdirection. What the eyes see and the ears hear, the mind believes');
        $Article3->setArticle('Lorem ipsumvehicula nunc non leo hendrerit commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $Article3->setImage('misdirection.jpg');
        $Article3->setAuthor('Gabriel');
        $Article3->setTags('misdirection, magic, movie, hacking, symArticle');
        $Article3->setCreated($date->format('Y-m-d H:i:s'));
        $Article3->setUpdated($Article3->getCreated());
        $manager->persist($Article3);

        $Article4 = new Article();
        $Article4->setTitle('The grid - A digital frontier');
        $Article4->setArticle('Lorem commodo. Vestibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque. Nulla consectetur tempus nisl vitae viverra.');
        $Article4->setImage('the_grid.jpg');
        $Article4->setAuthor('Kevin Flynn');
        $Article4->setTags('grid, daftpunk, movie, symArticle');
        $Article4->setCreated($date->format('Y-m-d H:i:s'));
        $Article4->setUpdated($Article4->getCreated());
        $manager->persist($Article4);

        $Article5 = new Article();
        $Article5->setTitle('You\'re either a one or a zero. Alive or dead');
        $Article5->setArticle('Lorem ipsum dolor sit amet, consectetur adipiscing elittibulum vulputate mauris eget erat congue dapibus imperdiet justo scelerisque.');
        $Article5->setImage('one_or_zero.jpg');
        $Article5->setAuthor('Gary Winston');
        $Article5->setTags('binary, one, zero, alive, dead, !trusting, movie, symArticle');
        $Article5->setCreated($date->format('Y-m-d H:i:s'));
        $Article5->setUpdated($Article5->getCreated());
        $manager->persist($Article5);

        $manager->flush();
    }

}