pipeline {
    options { timeout(time: 25, unit: 'MINUTES') }
    agent any
    environment {
        CONTAINER_NAME='inex'
        ECR_ADDRESS='276242186269.dkr.ecr.eu-central-1.amazonaws.com/inex'
        CONTAINER_NAME_FRONT='inex_front'
        CONTAINER_NAME_BACK='inex_back'
    }
    stages {
        stage ('Build Back') {
            steps {
                sh 'ls -alh'
                sh 'docker build -t $CONTAINER_NAME:back -f ./docker/Dockerfile.staging.backend .'
            }
        }
        stage ('Test') {
            steps {
                script {
                    docker.image('selenium/standalone-chrome').withRun('--name selenium -itd --network=test') {
                        c ->
                        docker.image("$CONTAINER_NAME:back").inside('--name inex_back -itd --network=test') {
                            //sh 'cd /home/inex/inex_backend; php vendor/bin/codecept run acceptance FirstCest.php --debug'
                        }
                        docker.image('selenium/standalone-chrome').inside('-itd --network=test') {
                            sh 'curl inex_back:8001'
                            sh 'echo test'
                        }
                    }
                }
            }
        }
//         stage ('Build Front') {
//             steps {
//                 sh 'docker build -t $CONTAINER_NAME:front -f ./docker/Dockerfile.staging.frontend . '
//                 sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
//                 sh 'docker tag $CONTAINER_NAME:front $ECR_ADDRESS:front'
//                 sh 'docker push $ECR_ADDRESS:front'
//                 sh 'echo "Delete image"'
//                 sh 'docker image rm -f ${CONTAINER_NAME}:front && docker image prune -f'
//             }
//         }
//         stage ('Push Docker Images') {
//             steps {
//                 sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
//                 sh 'docker tag $CONTAINER_NAME:back $ECR_ADDRESS:back'
//                 sh 'docker push $ECR_ADDRESS:back'
//                 sh 'echo "Delete image"'
//                 sh 'docker image rm -f ${CONTAINER_NAME}:back && docker image prune -f'
//             }
//         }
//         stage('Deploy') {
//             steps {
//                 sshPublisher(publishers: [sshPublisherDesc(configName: 'deploy', transfers: [sshTransfer(cleanRemote: false, excludes: '', execCommand: "\$(aws ecr get-login --no-include-email --region eu-central-1) && docker pull ${ECR_ADDRESS}:back && docker pull ${ECR_ADDRESS}:front && docker rm -f ${CONTAINER_NAME_FRONT} && docker rm -f ${CONTAINER_NAME_BACK} ; docker run --name ${CONTAINER_NAME_BACK} -d -p 8001:80 ${ECR_ADDRESS}:back && docker run --name ${CONTAINER_NAME_FRONT} -d -p 80:80 ${ECR_ADDRESS}:front", execTimeout: 120000, flatten: false, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: false)])
//             }
//         }
    }
//     post {
//         always {
//             cleanWs()
//             sh 'docker system prune -f'
//         }
//     }
}